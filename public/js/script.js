

var nilaiTerpilih = "";

$(document).ready(function () {
  // Ambil elemen-elemen yang diperlukan
  var progressBar = $(".progress-bar");
  var steps = $(".step");
  var prevButton = $("#prev-btn");
  var nextButton = $("#next-btn");
  var submitButton = $("#submit-btn");
  var preloaderWrapper = $("#preloader-wrapper");
  var successSection = $("#success");

  // Inisialisasi langkah dan total langkah
  var currentStep = 0;
  var totalSteps = steps.length;

  // Fungsi untuk menampilkan preloader
  function showPreloader() {
    preloaderWrapper.show();
  }

  // Fungsi untuk menyembunyikan preloader
  function hidePreloader() {
    preloaderWrapper.hide();
  }

  // Fungsi untuk menampilkan bagian sukses
  function showSuccess() {
    steps.hide();
    successSection.show();
  }

  // Fungsi untuk menyesuaikan tampilan sesuai langkah
  function updateView() {
    // Perbarui tampilan progres bar
    var progressPercentage = (currentStep / (totalSteps - 1)) * 100;
    progressBar.width(progressPercentage + "%");

    // Sembunyikan atau tampilkan tombol berdasarkan langkah
    prevButton.toggle(currentStep > 0);
    nextButton.toggle(currentStep < totalSteps - 1);
    submitButton.toggle(currentStep === totalSteps - 1);

    // Sembunyikan atau tampilkan langkah-langkah
    steps.hide();
    steps.eq(currentStep).show();
  }

  // Tambahkan event listener untuk tombol "Lanjut"
  nextButton.on("click", function () {
    // Validasi pada langkah sebelumnya sebelum pindah ke langkah berikutnya

    // console.log("Next before: " + currentStep + " | " + nilaiTerpilih);
    // Validasi pada langkah sebelumnya sebelum pindah ke langkah berikutnya
    if (validateStep(currentStep)) {
      if (currentStep === 0) {
        // Jika ini langkah pertama, lakukan pengecekan data menggunakan Ajax
        checkDataAndProceed();
      } else if (currentStep === 6) {
        // Langsung ke step 7 jika berada di step 6

        if (
          nilaiTerpilih != "MENIKAH" &&
          typeof nilaiTerpilih !== "undefined"
        ) {
          currentStep = 8;
          updateView();
        } else {
          currentStep++;
          updateView();
        }
      } else {
        currentStep++;
        updateView();
      }
    }
  });

  // Tambahkan event listener untuk tombol "Kembali"
  prevButton.on("click", function () {
    // console.log("Kembali : " + currentStep + " | " + nilaiTerpilih);
    if (currentStep > 0) {
      if (currentStep === 8) {
        // Langsung ke step 5 jika berada di step 6
        if (
          nilaiTerpilih != "MENIKAH" &&
          typeof nilaiTerpilih !== "undefined"
        ) {
          currentStep = 5;
          updateView();
        } else {
          currentStep--;
          updateView();
        }
      } else {
        currentStep--;
        updateView();
      }
    }
  });

  function checkDataAndProceed() {
    // Dapatkan nilai data yang akan dicek
    var nik_ktp = steps.eq(currentStep).find(".nik_ktp").val();

    // Data yang akan dikirim
    var data = {
      no_ktp_pemohon: nik_ktp,
    };

    showLoadingSpinner();

    $.ajax({
      type: "POST",
      url: apiurl + "/restapi_credit_online/nik_ktp",
      data: data,
      success: function (response) {
        hideLoadingSpinner();
        response = JSON.parse(response);

        // console.log(response)

        if (response && response.los_data_where_nik) {

          // Swal.fire({
          //   // title: '',
          //   text: "Nik telah terdaftar",
          //   icon: 'info',
          //   toast: true,
          //   timer: 3000,
          //   position: 'top-end',
          //   showConfirmButton: false
          // })

          var pemohon = response.los_data_where_nik;

          if (pemohon !== undefined && pemohon !== null) {
            $("#nama_pemohon").val(pemohon.nama_pemohon);
            $("#tempat_lahir_pemohon").val(pemohon.tempat_lahir_pemohon);
            $("#tgl_lahir_pemohon").val(pemohon.tgl_lahir_pemohon);
            $(
              'input[name="jenis_kelamin_pemohon"][value="' +
              pemohon.jenis_kelamin_pemohon +
              '"]'
            ).prop("checked", true);
            $("#nama_ibu_kandung_pemohon").val(
              pemohon.nama_ibu_kandung_pemohon
            );
            $("#no_ktp_pemohon").val(pemohon.no_ktp_pemohon);
            $("#npwp_pemohon").val(pemohon.npwp_pemohon);
            $("#alamat_ktp_pemohon").val(pemohon.alamat_ktp_pemohon);
            $("#telepon_pemohon").val(pemohon.telepon_pemohon);

            currentStep++;
            updateView();
          } else {
            var ktp1 = $('.nik_ktp').val()
            $("#no_ktp_pemohon").val(ktp1);
            alert("Data tidak ditemukan. Silakan coba lagi." + ktp1);

            currentStep++;
            updateView();
          }
        } else {

          var ktp1 = $('.nik_ktp').val()
          $("#no_ktp_pemohon").val(ktp1);
          // alert("Respons tidak sesuai format yang diharapkan." + ktp1);
          // Swal.fire({
          //   // title: '',
          //   text: "Nik belum terdaftar",
          //   icon: 'info',
          //   toast: true,
          //   timer: 3000,
          //   position: 'top-end',
          //   showConfirmButton: false
          // })

          currentStep++;
          updateView();
        }
      },
      error: function (error) {
        hideLoadingSpinner();
        // Handle error jika terjadi
        console.log("Error in Ajax request");
        // Lanjutkan ke langkah berikutnya
        currentStep++;
        updateView();
      },
    });
  }



  function validateSelect(element) {
    // Periksa apakah ini elemen Select2
    if (element.hasClass("js-example-basic-single")) {
      var selectContainer = element.next(".select2-container");

      if (!element.val()) {
        setInvalid(selectContainer, "Bagian ini wajib terisi");
        // console.log("salah");
        return false;
      } else {
        setValid(selectContainer);
        // console.log("benar");
        return true;
      }
    }
    // Handle elemen select biasa
    else if (element.is("select")) {
      if (element.val() === null || element.val() === "") {
        setInvalid(element, "Bagian ini wajib terisi");
        return false;
      } else {
        setValid(element);
        return true;
      }
    }
  }

  function validateRadio(element) {
    var radioGroupName = element.attr("name");
    if ($('input[name="' + radioGroupName + '"]:checked').length === 0) {
      setInvalid(element, "Pilih salah satu opsi");
      return false;
    } else {
      setValid(element);
      return true;
    }
  }

  function validateInput(element) {
    if (element.val() === "") {
      setInvalid(element, "Bagian ini wajib terisi");
      return false;
    } else {
      setValid(element);
      return true;
    }
  }

  function setInvalid(element, errorMessage) {
    element.addClass("is-invalid");
    element.siblings(".error-message").text(errorMessage);
    element.addClass("shake");
  }

  function setValid(element) {
    element.removeClass("is-invalid");
    element.siblings(".error-message").text("");
    element.removeClass("shake");
  }

  function validateStep(step) {
    var requiredFields = steps.eq(step).find("[required]");
    var isValid = true;

    requiredFields.each(function () {
      var element = $(this);

      if (element.is("select")) {
        isValid = validateSelect(element) && isValid;
      } else if (element.is(":radio")) {
        isValid = validateRadio(element) && isValid;
      } else {
        isValid = validateInput(element) && isValid;
      }
    });

    return isValid;
  }


  // Menambahkan event listener ke elemen formulir
  $("form").on("keydown", function (e) {
    // Mengecek apakah tombol yang ditekan adalah "Enter"
    if (e.key === "Enter") {
      e.preventDefault(); // Menghentikan event jika "Enter" ditekan
    }
  });



  // Tambahkan fungsi untuk menampilkan pesan loading
  function showLoadingMessage() {
 
    Swal.fire({
      title: 'Loading...',
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      },
      showConfirmButton: false,
    });
  }

  // Tambahkan fungsi untuk menyembunyikan pesan loading
  function hideLoadingMessage() {
    // Sembunyikan pesan loading atau indikator lainnya
    Swal.close();
  }



  // Tambahkan event listener untuk tombol "Submit"
  submitButton.on("click", function (e) {
    e.preventDefault(); // Hindari pengiriman formulir default

    // Menampilkan pesan loading
    showLoadingMessage();


    // Menghapus format rupiah sebelum mengirimkan nilai
    $(".rupiah").each(function () {
      var unformattedValue = unformatRupiah($(this).val());
      $(this).val(unformattedValue);
    });



    if (validateStep(currentStep)) {
      var formData = new FormData($('.form')[0]);

      $.ajax({
        url: url,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {


          if (response.message != 'berhasil') {
            hidePreloader();
            hideLoadingMessage();


            var pesaneror = ''

            $.each(response.errors, function (key, value) {
              // console.log(key + ": " + value[0]);
              // pesaneror = key + ": " + value[0];
              pesaneror = value[0];
              // Tampilkan pesan kesalahan validasi ke pengguna atau lakukan tindakan lainnya
            });


            Swal.fire({
              text: pesaneror,
              icon: 'warning',
              toast: true,
              timer: 5000,
              position: 'top-end',
              showConfirmButton: false
            }).then(() => {
              // window.location.href = '/';
            })
          } else if (response.message == 'berhasil') {

            showPreloader();

            hideLoadingMessage();
            prevButton.hide();
            submitButton.hide();

            setTimeout(function () {
              hidePreloader();
              showSuccess();
            }, 1000);

          }


        },
        error: function (xhr) {
          hideLoadingMessage();
          console.log("Kesalahan pada sisi klien:", xhr.statusText);
          // Swal.fire({
          //   // title: '',
          //   text: xhr.responseText,
          //   icon: 'warning',
          //   toast: true,
          //   timer: 3000,
          //   position: 'top-end',
          //   showConfirmButton: false
          // })
        },
      });

      // Lakukan submit formulir atau lakukan tindakan sesuai kebutuhan

    } else {
      hideLoadingMessage();
      alert("Mohon lengkapi isian yang dibutuhkan sebelum mengirim formulir.");
    }
  });

  // Inisialisasi tampilan awal
  updateView();
});

function formToObject(formSerialized) {
  var obj = {};
  var formDataArray = formSerialized.split("&");

  for (var i = 0; i < formDataArray.length; i++) {
    var pair = formDataArray[i].split("=");
    obj[pair[0]] = decodeURIComponent(pair[1] || "");
  }

  return obj;
}

// atur input semua huruf besar kecuali class input number
$(document).ready(function () {
  // Menangkap perubahan pada semua input dengan tipe teks
  $("input[type='text']").on("input", function () {
    // Jika elemen input tidak memiliki class "input-number"
    if (!$(this).hasClass("input-number")) {
      // Mengubah nilai input menjadi huruf besar
      var inputValue = $(this).val().toUpperCase();
      $(this).val(inputValue);
    } else {
      // Jika elemen input memiliki class "input-number"
      // Hanya mengizinkan input angka
      var inputValue = $(this)
        .val()
        .replace(/[^0-9]/g, "");

      if (!$(this).hasClass("input-number ktp")) {
        // Atur nilai input
        $(this).val(inputValue);
      } else {
        // Validasi jumlah digit
        if (inputValue.length > 16) {
          // Jika jumlah digit lebih dari 16
          // Atur nilai input menjadi 16 digit pertama
          $(this).val(inputValue.substring(0, 16));

          // Tandai input sebagai tidak valid
          $(this).addClass("is-invalid");

          // Tampilkan pesan error di elemen error-message
          $(this)
            .siblings(".error-message")
            .text("Jumlah digit tidak boleh melebihi 16.");
        } else {
          // Jika jumlah digit sesuai atau kurang dari 16
          // Bersihkan class "is-invalid" jika sebelumnya ditandai sebagai tidak valid
          $(this).removeClass("is-invalid");

          // Atur nilai input
          $(this).val(inputValue);
        }
      }
    }
  });
});

function ajax_send(url, type, data, dataType, callback) {
  $.ajax({
    url: url,
    type: type,
    data: data,
    dataType: dataType,

    success: function (response) {
      callback({ sukses: true, data: response });
    },
    error: function (error) {
      var data = {
        sukses: false,
        data: error,
      };
      callback(data);
    },
  });
}

$(document).ready(function () {
  // Lakukan request AJAX ke API

  var url = apiurl + "/restapi_credit_online/jenis_jaminan";
  var type = "GET";
  var data = "";
  var dataType = "json";

  ajax_send(url, type, data, dataType, function (res) {
    if (res.sukses) {
      select_jenis_jaminan(res.data);
    }
  });

  function select_jenis_jaminan(res) {
    // Dapatkan elemen select
    var selectElement = $(".jenis_jaminan");

    // Hapus semua opsi sebelum menambahkan yang baru
    selectElement.empty();

    // Tambahkan opsi default
    selectElement.append(
      "<option selected disabled>- Silahkan Pilih -</option>"
    );

    // Loop melalui data dan tambahkan sebagai opsi ke dalam select
    $.each(res.ref_jenis_jaminan, function (index, item) {
      // Sesuaikan dengan struktur data API Anda
      var option = $("<option>", {
        value: item.nama_jaminan,
        text: item.nama_jaminan,
      });
      selectElement.append(option);
    });
  }
});

// select dapatkan value
$(".kantor_cabang").change(function () {
  var kode_cabang = $(".kantor_cabang").val();
  // console.log("kode_cabang : " + kode_cabang);

  var url = apiurl + "/restapi_credit_online/instansi";
  var type = "POST";
  var data = { kode_cabang: kode_cabang, token: "faturungimuharram" };
  var dataType = "json";

  ajax_send(url, type, data, dataType, function (res) {
    if (res.sukses) {
      // console.log(res);
      select_ref_instansi(res.data);
    }
  });
});

function select_ref_instansi(res) {
  // Ambil elemen select berdasarkan ID
  var selectElement = $("#nama_instansi");
  var kodeInstansiInput = $("#kode_instansi");

  // Hapus semua opsi sebelum menambahkan yang baru
  selectElement.empty();

  // Tambahkan opsi default
  selectElement.append("<option selected disabled>- Silahkan Pilih -</option>");

  // Loop melalui data dan tambahkan sebagai opsi ke dalam select
  $.each(res, function (index, item) {
    // Sesuaikan dengan struktur data API Anda
    var option = $("<option>", {
      value: item.nama_instansi,
      text: item.kode_instansi + " - " + item.nama_instansi,
    });
    selectElement.append(option);
  });

  // Tambahkan event handler untuk perubahan nilai pada elemen select
  selectElement.on("change", function () {
    // Ambil nilai teks dari opsi yang dipilih
    var selectedText = selectElement.find("option:selected").text();

    // Ambil bagian kode_instansi dari teks yang terpilih
    var kodeInstansi = selectedText.split(" - ")[0].trim();

    // Update nilai input kode_instansi sesuai dengan nilai yang diambil
    kodeInstansiInput.val(kodeInstansi);

    // Tampilkan nilai kode_instansi di console
    // console.log('Kode instansi : ' + kodeInstansi + " nama instansi : " + selectElement.val());
  });
}

$(document).ready(function () {
  $("#status_perkawinan").change(function () {
    // Mendapatkan nilai terpilih dari select
    nilaiTerpilih = $(this).val();

    var requiredPasanganElements = $(".required_pasangan");

    // Periksa nilaiTerpilih dan tambahkan atau hapus kelas sesuai kebutuhan
    if (nilaiTerpilih != "MENIKAH" && typeof nilaiTerpilih !== "undefined") {
      requiredPasanganElements.removeClass("required");
    } else {
      requiredPasanganElements.addClass("required");
    }

    if (nilaiTerpilih != "MENIKAH" && typeof nilaiTerpilih !== "undefined") {
      requiredPasanganElements.removeClass("required");
      requiredPasanganElements.removeAttr("required");
    } else {
      requiredPasanganElements.addClass("required");
      requiredPasanganElements.prop("required", true);
    }
  });
});

// rupiah
function formatRupiah(angka) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  // Tambahkan koma dan angka desimal jika ada
  rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;

  return rupiah;
}

$(document).on("input", ".rupiah", function () {
  var inputValue = $(this).val();
  var formattedValue = formatRupiah(inputValue);
  $(this).val("Rp " + formattedValue);
});


// Fungsi untuk menghapus format rupiah sebelum submit
function unformatRupiah(rupiah) {
  return rupiah.replace(/[^\d]/g, ""); // Menghapus semua karakter selain digit
}


$(document).ready(function () {
  // Inisialisasi Select2
  $(".js-example-basic-single").select2({
    width: "100%",
    height: "40px",
  });

  // Atur tinggi untuk input Select2
  $(".select2-container").css("height", "40px");
  $(".select2-selection, .select2-selection__rendered").css("height", "40px");
});


$(document).ready(function () {

  var file2Inputs = $('.file2 input');


  $("#status_perkawinan").change(function () {

    nilaiTerpilih = $(this).val();

    if (nilaiTerpilih != "MENIKAH" && typeof nilaiTerpilih !== "undefined") {
      file2Inputs.removeAttr('required');
      $('.file2').hide();
      // console.log("hide " + nilaiTerpilih)
    } else {
      file2Inputs.prop('required', true);
      $('.file2').show();
      // console.log("show " + nilaiTerpilih)
    }
  })

})


// Tampilkan loading spinner
function showLoadingSpinner() {
  $("#spinner").show();
}

// Sembunyikan loading spinner
function hideLoadingSpinner() {
  $("#spinner").hide();
}
