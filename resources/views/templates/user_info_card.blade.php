<script id="user_info_card" type="text/template">
    <div class="user_card">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="form-group ui-widget">
            <label>Name</label>
            <input type="text" name="name" class="form-control name" placeholder="Enter name" autocomplete="off">
            <span class="text-danger hide name_required">Please fill the name field</span>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control phone" placeholder="Enter Phone" autocomplete="off">
            <span class="text-danger hide phone_required">Please fill the phone field</span><br>
            <span class="text-danger hide phone_invalid">Phone number is not valid</span>
        </div>
        <hr>
    </div>
</script>