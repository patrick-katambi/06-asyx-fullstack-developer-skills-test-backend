<?php

namespace App\Http\Traits;

use App\Models\ImpactLevel;
use App\Models\Priority;
use App\Models\ResolutionCode;
use App\Models\TicketCategory;
use App\Models\TicketState;
use App\Models\User;
use App\Models\UserGroup;
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


    # PRIORITY ROUTE

    /**
     * get all priority rows from database
     */

    protected function getPriorities()
    {
        $priorities = Priority::all();
        return $priorities;
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


    # TICKET STATE ROUTE

    /**
     * get all ticket states rows from database
     */

    protected function getTicketStates()
    {
        $ticket_states = TicketState::all();
        return $ticket_states;
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


    # RESOLUTION CODE ROUTE

    /**
     * get all resolution codes rows from database
     */

    protected function getResolutionCodes()
    {
        $resolution_codes = ResolutionCode::all();
        return $resolution_codes;
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
}
