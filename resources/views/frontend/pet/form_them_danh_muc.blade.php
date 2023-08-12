<form action="/your-endpoint" method="POST">
    @csrf
    <input type="text" id="inputData" name="inputData" placeholder="Them danh muc"
    style="width: 138px; border: none; font-size: 14px; padding-left:0px 0px 28px 74px"
    >
    <button type="submit" style="background: #d4816e">Thêm</button>
</form>

@include('frontend.pet.form_them_danh_muc')                      
