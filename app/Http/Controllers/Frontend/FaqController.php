<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\FaqStatus;
use App\Http\Controllers\FrontendController;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends FrontendController
{
    public function index(Request $request)
    {
        $queryInstance = Faq::query();

        if ($request->has('q')) {
            $q = $request->get('q');
            $queryInstance->where('title', 'LIKE', "%$q%");
            $queryInstance->orWhere('description', 'LIKE', "%$q%");
        }

        $this->data['faqs'] = $queryInstance->where('status', FaqStatus::ACTIVE)->get();
        return view('frontend.faq.index', $this->data);
    }
}
