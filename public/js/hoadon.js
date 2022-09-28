const callInfoCayCanh = function () {
    console.log("call");
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
// setInterval(function () {
//     callInfoCayCanh();
// }, 3000);

$("#MaLoaiCay").on("change", function (e) {
    var valueSelected = this.value;
    $.ajax({
        method: "GET",
        url: `/detailcaycanh/${valueSelected}`,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            $("#Gia").val(data.DonGiaBan);
        },
        error: function (err) {
            console.log(err);
        },
    });

    $("#TenCay").val(valueSelected);
});
const lick = 0;
$("#add-cay").on("click", function (e) {
    const el = $("#tr-body").get()

    $("#table-body").append(el[0].cells);
});
