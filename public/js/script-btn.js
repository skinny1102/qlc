const btn_delete_cay = document.getElementsByClassName("btn-delete-cay");

for (let i = 0; i < btn_delete_cay.length; i++) {
    const element = btn_delete_cay[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deleteMaloaicay").val(id);
        $("#form-delete").submit();
    });
}


const btn_delete_caycanh = document.getElementsByClassName("btn-delete-caycanh");

for (let i = 0; i < btn_delete_caycanh.length; i++) {
    const element = btn_delete_caycanh[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        console.log(id);
        $("#deleteMaCay").val(id);
        $("#form-delete").submit();
    });
}

const btn_delete_khachhang = document.getElementsByClassName("btn-delete-khachhang");

for (let i = 0; i < btn_delete_khachhang.length; i++) {
    const element = btn_delete_khachhang[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deleteKhachhang").val(id);
        $("#form-delete").submit();
    });
}

const btn_delete_nhanvien = document.getElementsByClassName("btn-delete-nhanvien");

for (let i = 0; i < btn_delete_nhanvien.length; i++) {
    const element = btn_delete_nhanvien[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deleteNhanvien").val(id);
        $("#form-delete").submit();
    });
}
