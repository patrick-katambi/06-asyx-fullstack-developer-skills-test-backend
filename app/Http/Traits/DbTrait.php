<?php

namespace App\Http\Traits;

use App\Models\ImpactLevel;
use App\Models\Priority;
use App\Models\ResolutionCode;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketState;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait DbTrait
{
    # USER ROUTE

    /**
     * identifying a user by email passed, since the email is unique
     * for all users
     */
    protected function queryRegisteredUser(string $email)
    {
        $registered_user = User::where('email', $email)->first();
        return $registered_user;
    }


    /**
     * deleting a token associated with a particular user using passed id
     */

    protected function deleteUserToken(int $user_id): int
    {
        $recordRemoved = DB::table('personal_access_tokens')->where('tokenable_id', $user_id)->delete();
        return $recordRemoved;
    }

    // protected function deleteUserToken


    # PRIORITY ROUTE

    /**
     * get all priority rows from database
     */

    protected function getPriorities()
    {
        $priorities = Priority::all();
        return $priorities;
    }

    protected function getPriorityById($id): Priority
    {
        return Priority::find($id);
    }


    # IMPACT LEVELS ROUTE

    /**
     * get all impact levels rows from database
     */

    protected function getImpactLevels()
    {
        $impact_levels = ImpactLevel::all();
        return $impact_levels;
    }

    protected function getImpactLevelById($id): ImpactLevel
    {
        return ImpactLevel::find($id);
    }


    # TICKET STATE ROUTE

    /**
     * get all ticket states rows from database
     */

    protected function getTicketStates()
    {
        $ticket_states = TicketState::all();
        return $ticket_states;
    }

    protected function getStateById($id): TicketState
    {
        return TicketState::find($id);
    }


    # TICKET CATEGORY ROUTE

    /**
     * get all ticket categories rows from database
     */

    protected function getTicketCtegories()
    {
        $ticket_category = TicketCategory::all();
        return $ticket_category;
    }

    protected function getTicketCategoryById($id): TicketCategory
    {
        return TicketCategory::find($id);
    }


    # RESOLUTION CODE ROUTE

    /**
     * get all resolution codes rows from database
     */

    protected function getResolutionCodes()
    {
        $resolution_codes = ResolutionCode::all();
        return $resolution_codes;
    }

    protected function getResolutionCodeById($id): ResolutionCode
    {
        return ResolutionCode::find($id);
    }


    # USER GROUP ROUTE

    /**
     * get all user group rows from database
     */

    protected function getUserGroups()
    {
        $user_groups = UserGroup::all();
        return $user_groups;
    }

    protected function getUsersByGroupId($group_id)
    {
        $users = UserGroup::find($group_id)->users;
        return $users;
    }


    # USERS BY USER GROUP ID ROUTE

    /**
     * get all users by user group id rows from database
     */

    protected function getUsersByUserGroupId(int $user_group_id)
    {
        $users = UserGroup::find($user_group_id)->users;
        return $users;
    }

    /**
     * get reference of user group by id
     */
    protected function getUserGroupById(int $user_group_id): UserGroup
    {
        $user_group = UserGroup::find($user_group_id);
        return $user_group;
    }


    # TICKETS ROUTE

    /**
     * get all tickets from the database
     */
    protected function getAllTickets()
    {

        $modified_ticket_response = array();

        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {
            $created_by = $this->getUserById($ticket->created_by);
            $user_group = $ticket->assignment_group !== null ? $this->getUserGroupById($ticket->assignment_group) : null;
            $assigned_to = $ticket->assigned_to !== null ? $this->getUserById($ticket->assigned_to) : null;
            $category = $this->getTicketCategoryById($ticket->category);
            $impact = $this->getImpactLevelById($ticket->impact);
            $priority = $this->getPriorityById($ticket->priority);
            $state = $this->getStateById($ticket->state);
            $resolved_by = $ticket->resolved_by !== null ? $this->getUserById($ticket->resolved_by) : null;
            $resolution_code = $ticket->resolution_code !== null ? $this->getResolutionCodeById($ticket->resolution_code) : null;

            $new_ticket_instance = [
                'id' => $ticket->id,
                'caller' => $ticket->caller,
                'description' => $ticket->description,
                'short_desc' => $ticket->short_desc,
                'created_by' => $created_by,
                'due_date' => $ticket->due_date,
                'user_group' => $user_group,
                'assigned_to' => $assigned_to,
                'category' => $category,
                'impact' => $impact,
                'priority' => $priority,
                'state' => $state,
                'resolved_by' => $resolved_by,
                'resolution_code' => $resolution_code,
                'resolution_note' => $ticket->resolution_note,
                'resolution_date' => $ticket->resolution_date,
                'created_at' => $ticket->created_at,
                'updated_at' => $ticket->updated_at,
            ];
            array_push($modified_ticket_response, $new_ticket_instance);
        }

        return $modified_ticket_response;
    }

    protected function getUserById(int $id): User
    {
        return User::find($id);
    }

    protected function createTicket(Request $request) : Ticket
    {
        $new_ticket_attributes = [
            'id' => $request->id,
            'caller' => $request->caller,
            'description' => $request->description,
            'short_desc' => $request->short_desc,
            'created_by' => $request->created_by,
            'due_date' => $request->due_date,
            'assignment_group' => $request->user_group,
            'assigned_to' => $request->assigned_to,
            'category' => $request->category,
            'impact' => $request->impact,
            'priority' => $request->priority,
            'state' => $request->state,
            'resolved_by' => $request->resolved_by,
            'resolution_code' => $request->resolution_code,
            'resolution_note' => $request->resolution_note,
            'resolution_date' => $request->resolution_date,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at,
        ];
        $new_ticket = Ticket::create($new_ticket_attributes);
        return $new_ticket;
    }

    protected function findTicketById($ticket_id):Ticket
    {
        return Ticket::find($ticket_id);
    }
}
