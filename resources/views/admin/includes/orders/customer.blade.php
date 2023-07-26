<div class="col-lg-4 col-md-4 col-sm-12" style="border: 1px solid #f1f1f1">
    <div class="text-center" style="margin: 20px 0">
        <img class="img-responsive" style="border-radius: 50%" src="{{ $data['user']['profile_photo_path'] ? asset($data['user']['profile_photo_path']) : $data['user']['profile_photo_url'] }}">
        <h6 style="margin-top:20px">{{ $data['user']['name'] }}</h6>
    </div>
    <hr>
    <div>
        <p><span style="font-size:13px">Email</span><br><a href="mailto:{{ $data['user']['email'] }}">{{ $data['user']['email'] }}</a></p>
        <p><span style="font-size:13px">Contact</span><br><a href="tel:{{ $data['contact'] }}">{{ $data['contact'] }}</a></p>
    </div>
    <hr>
    <div>
        <p><span style="font-size:13px">Shipping Address</span><br>
            <a target="_blank" href="http://maps.google.com/?q={{ $data['address']['address'] }}">{{ $data['address']['address'] }}</a></p>
    </div>
</div>
