<footer class=" footer-static d-block " style="background: #6F88E1B8;width: 100%; padding: 30px;color: #FFFFFF;">
    <p class="clearfix" style="color: #FFFFFF;">
    <h3> TRUNG TÂM ĐÀO TẠO LÁI XE </h3>
    <p style="color: #FFFFFF" class="d-flex row">
    <h4>Trụ sở chính: {{$configs->get('address')->value}} </h4>

    <h4> Điện thoại: {{$configs->get('phone_numbers')->value}} </h4>
    <h4> Email:{{$configs->get('email')->value}} </h4>

    </p>

    </p>
    <div>
        <b></b>
        <h3>FOLLOW US</h3>
        <a>
            <i data-feather="facebook" style="height: 50px;width: 100px;"></i>
        </a>
        <a>
            <i data-feather="instagram" style="height: 50px;width: 100px;"></i>
        </a>
    </div>
</footer>
