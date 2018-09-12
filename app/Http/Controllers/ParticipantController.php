<?php

namespace App\Http\Controllers;

use App\Helpers\Connection;
use App\Helpers\Store;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Shows conference participants create form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('participants_register');
    }

    /**
     * Stores new conference participants
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $participants = $request->get('participants');
        $data = [];

        if (empty($participants)) {
            return response([
                'error' => true,
                'message' => 'No participant have been selected'
            ]);
        }

        $groupId = Participant::max('group_id');
        $groupId = is_null($groupId) ? 1 : ++$groupId;
        $remoteCountryName = Connection::getIpInfo($_SERVER['REMOTE_ADDR'], 'country');

        foreach ($participants as $participant) {
            $data[]= array_merge($participant, [
                'country'  => $remoteCountryName,
                'group_id' => $groupId
            ]);
        }

        Participant::insert($data);

        return response([
            'error' => false,
            'message' => 'Record have been created successfully'
        ]);
    }

    /**
     * List all conference participants
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $participantGroups = Participant::all()
            ->groupBy('group_id')
            ->sortBy('role', SORT_REGULAR, true);
        return view('participants_list', compact('participantGroups'));
    }

    public function customers()
    {
        return Store::getCustomers();
    }
}
