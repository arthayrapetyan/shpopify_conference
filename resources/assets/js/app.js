import 'jquery-ui';

class App {
    constructor() {
        this.conferenceForm = document.querySelector('#conferenceForm');
        this.addRowBtn = this.conferenceForm.querySelector('.add_row');
        this.init();
    }

    init(e) {
        this.renderCard(e, true);
        this.handleEvents();
    }

    renderCard(e, isFirst) {
        const card = this.createNodeElementFromHTML(document.getElementById('user_info_card').innerHTML);
        const closeBtn = card.querySelector('.close');
        this.conferenceForm.insertBefore(card, this.conferenceForm.querySelector('.buttons'));
        // card.querySelector('.name').addEventListener('keyup', this.handleAutocomplete);

        if (isFirst) {
            closeBtn.remove();
        } else {
            closeBtn.addEventListener('click', () => { card.remove() });
        }

        this.handleAutocomplete();
    }

    handleEvents() {
        this.addRowBtn.removeEventListener('click', this.renderCard.bind(this));
        this.addRowBtn.addEventListener('click', this.renderCard.bind(this));
        $('#conferenceForm .submit').off('click').on('click', this.handleSubmit);
        $('#conferenceForm input').off('keyup').on('keyup', this.handleInputChange);
    }

    handleSubmit() {
        let participants = [];
        let user_card = $('.user_card');

        user_card.each(function(index, elem){
            let role = index == 0 ? 1 : 0;
            let name = elem.querySelector('.name').value;
            let phone = elem.querySelector('.phone').value;

            if (!name || !phone) {
                let classPrefix = !name ? 'name' : 'phone';
                user_card.find(`.${classPrefix}_required`).removeClass('hide');
                return;
            }

            participants.push({name, phone, role});
        });

        $.ajax({
            url: '/participants',
            method: 'POST',
            data: {
                'participants': participants
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.error){
                    return;
                }
                window.location.href = '/participants';
            }
        })
    }

    handleAutocomplete() {
        $.ajax({
            url: '/customers',
            method: 'GET'
        }).then(function (res) {
            let customers = JSON.parse(res).customers;
            const customersData = $.map(customers, function (value, key) {
                return {
                    id: value.id,
                    label: value.first_name,
                    value: `${value.first_name} ${value.last_name}`,
                    phone: value.addresses[0].phone || value.default_address.phone,
                    country: value.addresses[0].country || value.default_address.country
                }
            });

            $('.name').autocomplete({
                source: customersData,
                select: function (event, ui) {
                    const currentInput = event.target;
                    currentInput.setAttribute('data-id', ui.item.id);
                    currentInput.setAttribute('data-country', ui.item.country);
                    currentInput.closest('.user_card').querySelector('.phone').value = ui.item.phone;
                    return true;
                },
            })
        });
    }

    handleInputChange() {
        let inputValue = $(this).val();
        let inputName = $(this).attr('name');
        let requiredElem = $(this).parent().find(`.${inputName}_required`);
        let invalidElem = $(this).parent().find(`.${inputName}_invalid`);

        if (!inputValue) {
            requiredElem.removeClass('hide');
        } else {
            requiredElem.addClass('hide');
            if (inputName === 'phone' && inputValue.match(/[a-zA-Z]/)) {
                invalidElem.removeClass('hide');
            } else {
                invalidElem.addClass('hide');
            }
        }
    }

    createNodeElementFromHTML(htmlString) {
        let div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }
}

new App();