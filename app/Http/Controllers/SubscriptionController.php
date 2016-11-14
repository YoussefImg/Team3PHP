<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ReturnTrait;

    /**
     * ClassName to return on BeautifulRespons (Response Trait)
     * @var string
     */
    protected $className = 'Subscription';


    public function index()
    {
        $subscription = Subscription::all();
        return response()->json($subscription);
    }

    public function byID($id)
    {
        $subscription = Subscription::find($id);
        if (!empty($subscription))
            return response()->json($subscription);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        if ($request->RailCardID
            && $request->RouteID
            && $request->DiscountID
            && $request->ValidFrom
            && $request->ValidUntil
        ) {
            $subscription = new Subscription();
            $subscription->RailCardID = $request->RailCardID;
            $subscription->RouteID = $request->RouteID;
            $subscription->DiscountID = $request->DiscountID;
            $subscription->ValidFrom = $request->ValidFrom;
            $subscription->ValidUntil = $request->ValidUntil;

            if ($subscription->save())
                return $this->beautifyReturn(200, ['Extra' => 'Created', 'SubscriptionID' => $subscription->SubscriptionID]);

            return $this->beautifyReturn(406);
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        if (!empty($subscription)) {
            if ($request->RailCardID)
                $subscription->RailCardID = $request->RailCardID;
            if ($request->RouteID)
                $subscription->RouteID = $request->RouteID;
            if ($request->DiscountID)
                $subscription->DiscountID = $request->DiscountID;
            if ($request->ValidFrom)
                $subscription->ValidFrom = $request->ValidFrom;
            if ($request->ValidUntil)
                $subscription->ValidUntil = $request->ValidUntil;

            if ($subscription->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $subscription = Subscription::find($id);
        if (!empty($subscription)) {
            if ($subscription->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
