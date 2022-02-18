<?php

namespace ClimbingCard\Http\Admin;

use ClimbingCard\Http\Controller;
use function ClimbingCard\view;

class CardsController extends Controller
{
    /**
     * Display the settings admin page
     */
    public static function index()
    {
        return view('admin/cards/index');
    }
}