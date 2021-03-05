<?php

namespace App\Http\Livewire\Invite;

use Livewire\Component;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\Models\Token;

use App\Mail\Invitation;

class Create extends Component
{
    public $recipient_name;
    public $recipient_email_address;
    public $optional_message;

    public function render()
    {
        return view('livewire.invite.create');
    }

    public function create()
    {
        $token = new Token;
        $token->token = Str::uuid();
        $token->expires = Carbon::now()->addDays(7)->toDateTimeString();
        $token->save();

        Mail::to($this->recipient_email_address)
            ->send(new Invitation($this->recipient_name, $this->optional_message, $token));

        session()->flash('flash.banner', 'Invite sent to ' . $this->recipient_name . ' (' . $this->recipient_email_address . ')');
        session()->flash('flash.bannerStyle', 'success');

        $this->recipient_name = '';
        $this->recipient_email_address = '';
        $this->optional_message = '';
    }
}
