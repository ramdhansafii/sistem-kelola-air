$(document).ready(function () {
    const uri = window.location.href;
    const e = uri.split("=");
    console.log("URI: " + uri + " e[1]:" + e[1] + " e[2]:" + e[2]);
    console.log("level: ", lvl);
    console.log("user: ", yuser);
    
    function hideAllSections() {
        $("#summary,#chart,#user_add,#user_list,#tarif_add,#tarif_list,#meter_add,#meter_list,#pemakaian_list,#warga_list,#summary_warga,#summary_bendahara").hide();
    }

    function resetUserForm() {
        $("#user_form input,#user_form textarea").val('');
        $("#user_form input[name='yuser']").prop("disabled", false);
        $("#user_form button").val('user_add');
        $("#user_form input[name='yuser'][type='hidden']").remove();
    }

    function resetTarifForm() {
        $("#tarif_form input").val('');
        $("#tarif_form input[name='kd_tarif']").prop("disabled", false);
        $("#tarif_form button").val('tarif_add');
        $("#tarif_form input[name='kd_tarif'][type='hidden']").remove();
    }

    function resetMeterForm() {
        $("#meter_form input").val('');
        $("#meter_form input[name='no']").prop("disabled", false);
        $("#meter_form button").val('meter_add');
        $("#meter_form input[name='no'][type='hidden']").remove();
    }

    // === USER ===
    if (e[1] === "user" || e[1] === "user_edit&username") {
        hideAllSections();
        $("#user_list").show();

        if (e[1] === "user_edit&username" && e[2]) {
            $("#user_list").hide();
            $("#user_add").show();
            $("#user_form button").val('user_edit');
            $("#user_form input[name='yuser']").prop("disabled", true);
            $("#user_form input[name='yuser'][type='hidden']").remove();
            $("#user_form").append("<input type='hidden' name='yuser' value='" + e[2] + "'>");
        }

        $(".datatable-dropdown").append(`
            <button type='button' class='btn btn-outline-success float-start me-2'>
                <i class='fa-solid fa-user-plus'></i> User
            </button>
        `).find("button").click(function () {
            console.log("Tombol add user diklik");
            resetUserForm();
            $("#user_list").hide();
            $("#user_add").show();
        });

        $("button[data-bs-toggle='modal']").click(function () {
            const user = $(this).attr('data-user');
            $("#myModal .modal-body").text("Yakin Akan Hapus Data User : " + user);
            $(".modal-footer form input[name='user']").remove();
            $(".modal-footer form").append("<input type='hidden' name='user' value='" + user + "'>");
        });
    }

    // === TARIF ===
    else if (e[1] === "tarif" || e[1] === "tarif_edit&kd_tarif") {
        hideAllSections();
        $("#tarif_list").show();

        if (e[1] === "tarif_edit&kd_tarif" && e[2]) {
            $("#tarif_add").show();
            $("#tarif_list").hide();
            $("#tarif_form button").val('tarif_edit');
            $("#tarif_form input[name='kd_tarif']").prop("disabled", true);
            $("#tarif_form input[name='kd_tarif'][type='hidden']").remove();
            $("#tarif_form").append("<input type='hidden' name='kd_tarif' value='" + e[2] + "'>");
        }

        const table = document.getElementById('tarif_table');
        if (table) new simpleDatatables.DataTable(table);

        $(".datatable-dropdown").append(`
            <button type='button' class='btn btn-outline-success float-start me-2'>
                <i class='fa-solid fa-money-bill-wave fa-beat'></i> Tarif
            </button>
        `).find("button").click(function () {
            console.log("Tombol add tarif diklik");
            resetTarifForm();
            $("#tarif_list").hide();
            $("#tarif_add").show();
        });

        $("button[data-bs-toggle='modal']").click(function () {
            const kd_tarif = $(this).attr('data-kd_tarif');
            $("#myModal .modal-body").text("Yakin Akan Hapus Data Tarif " + kd_tarif);
            $(".modal-footer form input[name='kd_tarif']").remove();
            $(".modal-footer form").append("<input type='hidden' name='kd_tarif' value='" + kd_tarif + "'>");
            $(".modal-footer button").val('tarif_hapus');
        });
    }

    // === CATAT METER ===
    else if (e[1] === "catat_meter" || e[1] === "meter_edit&no") {
        hideAllSections();
        $("#meter_list").show();

        if (e[1] === "meter_edit&no" && e[2]) {
            $("#meter_add").show();
            $("#meter_list").hide();
            $("#meter_form input[name='no']").prop("disabled", true);
            $("#meter_form button").val('meter_edit');
            $("#meter_form input[name='no'][type='hidden']").remove();
            $("#meter_form").append("<input type='hidden' name='no' value='" + e[2] + "'>");
        }

        const table = document.getElementById('meter_table');
        if (table) new simpleDatatables.DataTable(table);

        $(".datatable-dropdown").append(`
            <button type='button' class='btn btn-outline-primary float-start me-2'>
                <i class='fa-solid fa-square-plus fa-fade'></i> Meter
            </button>
        `).find("button").click(function () {
            console.log("Tombol add meter diklik");
            resetMeterForm();
            $("#meter_list").hide();
            $("#meter_add").show();
        });

        $("button[data-bs-toggle='modal']").click(function () {
            const no = $(this).attr('data-no');
            $("#myModal .modal-body").text("Yakin Akan Hapus Data Meter " + no);
            $(".modal-footer form input[name='no']").remove();
            $(".modal-footer form").append("<input type='hidden' name='no' value='" + no + "'>");
            $(".modal-footer button").val('meter_hapus');
        });
    }

    // === PEMAKAIAN WARGA (TIDAK ADA TOMBOL TAMBAH) ===
    else if (e[1] === "pemakaian_warga") {
        hideAllSections();
        $("#pemakaian_list").show();

        const table = document.getElementById('pemakaian_table');
        if (table) new simpleDatatables.DataTable(table);

        $("button[data-bs-toggle='modal']").click(function () {
            const no = $(this).attr('data-no');
            $("#myModal .modal-body").text("Yakin Akan Hapus Data Pemakaian " + no);
            $(".modal-footer form input[name='no']").remove();
            $(".modal-footer form").append("<input type='hidden' name='no' value='" + no + "'>");
            $(".modal-footer button").val('meter_hapus');
        });
    }

    // === PEMAKAIAN SENDIRI ===
    else if (e[1] === "pemakaian_sendiri") {
        hideAllSections();
        $("#warga_list").show();

        const table = document.getElementById('warga_table');
        if (table) new simpleDatatables.DataTable(table);
    }

    // === DASHBOARD DEFAULT ===
    else {
        hideAllSections();
        $("#summary, #chart").show();

        const userLevel = $("body").data("level") || "";

        if (userLevel === "bendahara") {
            $("#summary, #summary_warga").hide();
            $("#summary_bendahara, #chart").show();
        } else if (userLevel === "warga") {
            $("#summary, #summary_bendahara").hide();
            $("#summary_warga, #chart").show();
        } else if (userLevel === "admin" || userLevel === "petugas") {
            $("#summary_warga, #summary_bendahara").hide();
            $("#summary, #chart").show();
        }

        $("#pilih_waktu select[name='waktu']").on("change", function () {
            const bln = $(this).val();
            console.log("Bulan dipilih: " + bln);

            const level = userLevel;
            const url = "../assets/ajax.php";
            let requestData = {};
            let updateUI = function () {};

            if (level === "admin" || level === "petugas") {
                requestData = { p: "summary", t: bln };
                updateUI = function (d) {
                    let blm_dicatat = d[0].jml_warga - d[2].tercatat;
                    $("#summary .bg-primary h1").text(d[0].jml_warga);
                    $("#summary .bg-warning h1").text(d[1].pemakaian);
                    $("#summary .bg-success h1").text(d[2].tercatat);
                    $("#summary .bg-danger h1").text(blm_dicatat);
                };
            } else if (level === "bendahara") {
                requestData = { p: "summary_bendahara", t: bln };
                updateUI = function (d) {
                    $("#summary_bendahara .bg-primary h1").text(d.total_payers);
                    $("#summary_bendahara .bg-warning h1").text(d.total_income.toLocaleString("id-ID"));
                    $("#summary_bendahara .bg-success h1").text(d.fully_paid);
                    $("#summary_bendahara .bg-danger h1").text(d.unpaid);
                };
            } else if (level === "warga") {
                requestData = { p: "summary_warga", t: bln };
                updateUI = function (d) {
                    $("#summary_warga .bg-primary h1").text(d.waktu_pencatatan || '-');
                    $("#summary_warga .bg-warning h1").text(d.pemakaian_air ?? 0);
                    $("#summary_warga .bg-success h1").text(d.total_tagihan ?? 0);
                    $("#summary_warga .bg-danger h1").text(d.status_tagihan || 'BLM LUNAS');
                };
            }

            $.ajax({
                type: "POST",
                url: url,
                data: requestData,
                dataType: "json"
            })
            .done(updateUI)
            .fail(function () {
                console.log("Terjadi kesalahan saat memuat data ringkasan.");
            });
        });

        // console.log("Mau AJAX jalan nih!");
        // var user = "<?= $_SESSION['user'] ?? 'guest' ?>";
        $.ajax({
            type: "POST",
            url: "../assets/ajax.php",
            data: { p: "chart_bar", y:yuser},
            dataType: "json",
            cache: false
        })
        .done(function(respon){

            sumbuX=respon.filter((num,index)=>index % 2 ==0);
            sumbuY=respon.filter((num,index)=>index % 2 !=0);
            console.log("respon : "+respon);
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Bar Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sumbuX,
                datasets: [{
                label: "pemakaian ",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: sumbuY,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'month'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 75,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    display: true
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });


        });

        $.ajax({
            type: "POST",
            url: "../assets/ajax.php",
            data: { p: "chart_line", y:yuser},
            dataType: "json",
            cache: false
        })
        .done(function(respon){

            sumbuX=respon.filter((num,index)=>index % 2 ==0);
            sumbuY=respon.filter((num,index)=>index % 2 !=0);
            // console.log("respon : "+respon);

            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#292b2c';

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: sumbuX,
                datasets: [{
                label: "Tagihan(Rp)",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: sumbuY,
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 350000,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });



        });
    }
});
