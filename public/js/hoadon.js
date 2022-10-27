// get info khachhang and  nhan vien
$.ajax({
    method: "GET",
    url: "/listkhachhang",
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (data) {
        data.forEach((element) => {
            console.log(element);
            $(".es-list").append(
                $(
                    `<li value=${element.MaKhachHang} class="es-visible"> ${element.MaKhachHang} - ${element.TenKhachHang} -${element.DienThoai}  </li>`
                )
            );
        });
    },
    error: function (err) {
        console.log(err);
    },
});

// $.ajax({
//     method: "GET",
//     url: "/listnhanvien",
//     headers: {
//         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//     },
//     success: function (data) {
//         console.log(data);
//         data.forEach((element) => {
//             $("#MaNhanVien").append(
//                 $("<option>", {
//                     value: element.MaNhanVien,
//                     text: element.TenNhanVien,
//                 })
//             );
//         });
//     },
//     error: function (err) {
//         console.log(err);
//     },
// });

const callInfoCayCanh = function () {
    $.ajax({
        method: "GET",
        url: "/listcaycanh",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            data.forEach((element) => {
                $(".ten-cay").append(
                    $("<option>", {
                        value: element.MaCay,
                        text: element.TenCay,
                    })
                );
            });
        },
        error: function (err) {
            console.log(err);
        },
    });
};
callInfoCayCanh();

const callApend = function (index) {
    $.ajax({
        method: "GET",
        url: "/listcaycanh",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            data.forEach((element) => {
                $(`#MaLoaiCay${index}`).append(
                    $("<option>", {
                        value: element.MaCay,
                        text: element.TenCay,
                    })
                );
            });
        },
        error: function (err) {
            console.log(err);
        },
    });
};

$("#MaLoaiCay").on("change", function (e) {
    var valueSelected = this.value;
    $.ajax({
        method: "GET",
        url: `/detailcaycanh/${valueSelected}`,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            $("#Gia1").val(data.DonGiaBan);
            $("#MaCay1").val(data.MaCay);
        },
        error: function (err) {
            console.log(err);
        },
    });

    $("#TenCay").val(valueSelected);
});
$(`#SoLuong1`).on("change", function (e) {
    const gia = $(`#Gia1`).val();
    const sl = $(`#SoLuong1`).val();
    const dongia = gia * sl;
    $(`#DonGia1`).val(dongia);
});
let lick = 1;
$("#add-cay").on("click", function (e) {
    lick++;
    const HTMLDomProduct = `
    <tr id="tr-body${lick}" data-id="tr-body${lick}">
        <th scope="row">
            <select class="form-control ten-cay" aria-label=".form-select-sm example" id="MaLoaiCay${lick}" name="TenCay">
                <option value="" selected></option>
            </select>
        </th>
        <td>
            <input type="text" class="form-control" id="MaCay${lick}" name="MaCay" style="width: 141px;" readonly>
        </td>
        </td>
        <td>
            <input type="text" class="form-control" id="Gia${lick}" name="Gia" style="width: 100px;" readonly>
        </td>
        </td>
        <td>
            <input type="text" class="form-control" id="SoLuong${lick}" name="SoLuong" style="width:100px;">
        </td>
        <td>
            <input type="text" class="form-control" id="DonGia${lick}" name="DonGia" style="width: 100px;" readonly>
        </td>
        </td>
        <td>
            <div class="btn btn-danger btn-xoa" data-id="${lick}" id="btn-xoa-${lick}">Xóa</div>
        </td>
    </tr>
`;
    $("#table-body").append(HTMLDomProduct);
    callApend(lick);
    $(`#MaLoaiCay${lick}`).on("change", function (e) {
        var valueSelected = this.value;
        $.ajax({
            method: "GET",
            url: `/detailcaycanh/${valueSelected}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                $(`#Gia${lick}`).val(data.DonGiaBan);
                $(`#MaCay${lick}`).val(data.MaCay);
            },
            error: function (err) {
                console.log(err);
            },
        });
    });

    $(`#btn-xoa-${lick}`).on("click", function (e) {
        const id = this.getAttribute("data-id");
        $(`#tr-body${id}`).remove();
    });
    $(`#SoLuong${lick}`).on("change", function (e) {
        const gia = $(`#Gia${lick}`).val();
        const sl = $(`#SoLuong${lick}`).val();
        const dongia = gia * sl;
        $(`#DonGia${lick}`).val(dongia);
    });
});

/// set tong product
setInterval(() => {
    const table = $("#table-body");
    const nodeListTable = table[0].childNodes;
    const idLineProduct = [];
    for (let index = 0; index < nodeListTable.length; index++) {
        const element = nodeListTable[index];
        if (element.nodeName != "#text") {
            idLineProduct.push(element.dataset.id);
        }
    }

    const value = [];
    idLineProduct.forEach((e) => {
        $(`#${e}`)
            .find('input[name="DonGia"]')
            .each(function () {
                value.push($(this).val());
            });
    });
    const tong = value.reduce((a, b) => Number(a) + Number(b), 0);
    $(`#TongTien`).val(tong);
}, 1000);

$("#btn-themmoihoadon").on("click", function (e) {
    const table = $("#table-body");
    const nodeListTable = table[0].childNodes;
    const idLineProduct = [];
    ///get id element
    for (let index = 0; index < nodeListTable.length; index++) {
        const element = nodeListTable[index];
        if (element.nodeName != "#text") {
            idLineProduct.push(element.dataset.id);
        }
    }
    const mangChitiet = [];
    idLineProduct.forEach((e) => {
        const value = [];
        let chiethoadon = {};
        $(`#${e}`)
            .find(
                'input[name="MaCay"],input[name="SoLuong"],input[name="DonGia"]'
            )
            .each(function () {
                value.push($(this).val());
            });
        chiethoadon = {
            MaCay: value[0],
            SoLuong: value[1],
            DonGia: value[2],
        };
        mangChitiet.push(chiethoadon);
    });
    const MaNhanVien = $("#MaNhanVien").val();
    // const MaKhachHang = $("#MaKhachHang").val();
    const MaKhachHang = $("#editable-select").val().split("-")[0].trim();
    const NgayLap = $("#NgayBan").val();
    const TongTien = $("#TongTien").val();
    const data = {
        MaNhanVien: Number(MaNhanVien),
        MaKhachHang: MaKhachHang,
        NgayLap: NgayLap + " 00:00:00",
        TongTien: TongTien,
        chitiet: mangChitiet,
    };
    if (
        mangChitiet[0].Dongia != "" &&
        mangChitiet[0].MaCay != "" &&
        mangChitiet[0].Soluong != ""
    ) {
        // check chitiet lon hon 0
    }
    if (
        MaKhachHang != "" &&
        mangChitiet.length > 0 &&
        mangChitiet[0].Dongia != "" &&
        mangChitiet[0].MaCay != "" &&
        mangChitiet[0].Soluong != ""
    ) {
        console.log(data);
        // $.ajax({
        //     method: "POST",
        //     url: "/themhoadon",
        //     data: data,
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        //     success: function (data) {
        //         location.reload();
        //     },
        //     error: function (err) {
        //         console.log(err);
        //     },
        // });
    }
});

$("#editable-select").editableSelect();
