<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;

const CREATE_METHOD = 'create';
const UPDATE_METHOD = 'update';
const DELETE_METHOD = 'delete';
const SORT_BY_DATE = 'date';
const SORT_CHRONOLOGICALLY = 'chronologically';

class EventController extends Controller
{
    public function list(Request $request)
    {
        $requestParams = json_decode($request->getContent());
        $events = Event::where('user_id', $requestParams->user_id);

        switch ($requestParams->sort_option){
            case SORT_BY_DATE:
                return $events->where('from_date', $requestParams->date)->orWhere('to_date', $requestParams->date)->get();
                break;
            case SORT_CHRONOLOGICALLY:
                return $events->orderBy('from_date','ASC')->get();
                break;
            default:
                return $events->get();
        }
    }

    public function update(Request $request)
    {
        $requestParams = json_decode($request->getContent());

        switch ($requestParams->method) {
            case CREATE_METHOD:
                $event = Event::create($request->all());
                return response()->json($event);
                break;
            case UPDATE_METHOD:
                $event = Event::where('id', $requestParams->event_id);
                $event->update($request->only(['user_id','description', 'location', 'from_date', 'to_date']));
                return response()->json($event);
                break;
            case DELETE_METHOD:
                $event = Event::where('id', $requestParams->event_id);
                $event->delete();
                return response()->json("Event deleted", 204);
                break;
            default:
                return response()->json("Missing or wrong parameters", 400);
                break;
        }
    }
}
