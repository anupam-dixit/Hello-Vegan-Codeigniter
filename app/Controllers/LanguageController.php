<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LanguageController extends BaseController
{
    public function index()
    {
        $session = session();
        $locale = $this->request->getLocale();
        $session->remove('lang');
        $session->set('lang', $locale);
        return redirect()->to($_GET['url']);
    }
}
