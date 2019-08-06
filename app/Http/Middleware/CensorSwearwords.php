<?php

namespace App\Http\Middleware;

use Closure;

class CensorSwearwords
{

    protected $swearwords = ['aq','fuck','ass'];

    protected function starize($messageText){
        $length = strlen($messageText);
        $newMessage = "";

        for ($i=0; $i<$length; $i++) $newMessage = $newMessage."*";

        return $newMessage;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $input = $request->all();

        if (isset($input['messageText'])){
            foreach ($this->swearwords as $swearword){
                if ($input['messageText']==$swearword || strpos($input['messageText'], $swearword) !== false)
                    $input['messageText'] = $this->starize($input['messageText']);
            }
        }

        $request->replace($input);

        /*

        */
        return $next($request);
    }
}
