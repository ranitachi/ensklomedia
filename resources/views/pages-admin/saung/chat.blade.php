  
    <div id="chatbox">
        @foreach ($chat as $item)
            <div class='msgln'>{!!$item->chat!!}</div>   
        @endforeach
        {{-- <div class='msgln'><i><b>agam</b> telah bergabung ke obrolan.</i><br></div>
        <div class='msgln'><i><b>widya</b> telah bergabung ke obrolan.</i><br></div>
        <div class='msgln'>[14:01] <b>agam</b>: hai<br></div>
        <div class='msgln'>[14:01] <b>widya</b>: halo<br></div>
        <div class='msgln'>[14:02] <b>widya</b>: Mau Tanya Donk...GImana ya caranya<br></div>
        <div class='msgln'><i><b>widya</b> telah meninggalkan obrolan.</i><br></div>
        <div class='msgln'>[14:05] <b>agam</b>: ddd<br></div> --}}
    </div>
   