const btn_delete_cay = document.getElementsByClassName("btn-delete-cay");

for (let i = 0; i < btn_delete_cay.length; i++) {
    const element = btn_delete_cay[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deleteMaloaicay").val(id);
        $("#form-delete").submit();
    });
}

// const btn_delete_caycanh =
//     document.getElementsByClassName("btn-delete-caycanh");

// for (let i = 0; i < btn_delete_caycanh.length; i++) {
//     const element = btn_delete_caycanh[i];
//     element.addEventListener("click", () => {
//         const id = element.getAttribute("data-id");
//         console.log(id);
//         $("#deleteMaCay").val(id);
//         $("#form-delete").submit();
//     });
// }

const btn_delete_khachhang = document.getElementsByClassName(
    "btn-delete-khachhang"
);

for (let i = 0; i < btn_delete_khachhang.length; i++) {
    const element = btn_delete_khachhang[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deleteKhachhang").val(id);
        $("#form-delete").submit();
    });
}

// const btn_delete_nhanvien = document.getElementsByClassName(
//     "btn-delete-nhanvien"
// );

// for (let i = 0; i < btn_delete_nhanvien.length; i++) {
//     const element = btn_delete_nhanvien[i];
//     element.addEventListener("click", () => {
//         const id = element.getAttribute("data-id");
//         $("#deleteNhanvien").val(id);
//         $("#form-delete").submit();
//     });
// }

// const btn_delete_hoadon = document.getElementsByClassName("btn-delete-hoadon");

// for (let i = 0; i < btn_delete_hoadon.length; i++) {
//     const element = btn_delete_hoadon[i];
//     element.addEventListener("click", () => {
//         const id = element.getAttribute("data-id");
//         $("#deletehoadon").val(id);
//         $("#form-delete").submit();
//     });
// }

const btn_delete_chitiethoadon = document.getElementsByClassName(
    "btn-delete-chitiethoadon"
);

for (let i = 0; i < btn_delete_chitiethoadon.length; i++) {
    const element = btn_delete_chitiethoadon[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#deletechitiethoadon").val(id);
        $("#form-delete").submit();
    });
}

const btn_suachitiethoadon = document.getElementsByClassName(
    "btn-suachitiethoadon"
);

for (let i = 0; i < btn_suachitiethoadon.length; i++) {
    const element = btn_suachitiethoadon[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        // $("#deletechitiethoadon").val(id);
        // $("#form-delete").submit();

        $.ajax({
            method: "GET",
            url: `/chitiethoadon/${id}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                $("#sl-chitiet").val(data.SoLuong);
                $("#caycanh-chitiet").val(data.MaCay).change();
                $("#id-chitiet").val(data.MaChiTietHoaDon);
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
}
///////////////////////// xác nhận xóa
// $('#modalDelete').on('show.bs.modal', function (event) {
// //   console.log("hihi");
// })
/// HOA DON
const btn_xoahoadon = document.getElementsByClassName("btn-delete-hoadon");
for (let i = 0; i < btn_xoahoadon.length; i++) {
    const element = btn_xoahoadon[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#modalDelete").data("id", id);

        $("#confirm-xoa").on("click", () => {
            $("#deletehoadon").val(id);
            $("#form-delete").submit();
        });
    });
}
// cAy anh 
const btn_xoacaycanh = document.getElementsByClassName("btn-delete-caycanh");
for (let i = 0; i < btn_xoacaycanh.length; i++) {
    const element = btn_xoacaycanh[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#confirm-xoa").on("click", () => {
        
            $("#deleteMaCay").val(id);
            $("#form-delete").submit();
        });
    });
}
// nhan vien 

const btn_delete_nhanvien = document.getElementsByClassName(
    "btn-delete-nhanvien"
);

for (let i = 0; i < btn_delete_nhanvien.length; i++) {
    const element = btn_delete_nhanvien[i];
    element.addEventListener("click", () => {
        const id = element.getAttribute("data-id");
        $("#confirm-xoa").on("click", () => {
            console.log("id");
            $("#deleteNhanvien").val(id);
            $("#form-delete").submit();
        });
    });
}