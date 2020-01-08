<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	/**
   * Display welcome page.
   *
   * @return \Illuminate\Http\Response
  */
	public function welcome()
  {
    return view('pages.welcome');
  }

  /**
   * Display about page.
   *
   * @return \Illuminate\Http\Response
  */
  public function about()
  {
   	return view('pages.about');
  }
}
