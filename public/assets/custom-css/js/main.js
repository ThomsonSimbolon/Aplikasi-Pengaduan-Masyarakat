// Script untuk menampilkan data yang upload yang ada di form tambah dan edit
$(document).on("change", "#file", function (e) {
  e.preventDefault();
  var fileName = e.target.files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});
// End Script untuk menampilkan data yang upload yang ada di form tambah dan edit

// Script untuk menampilkan data upload yang ada di form tambah dan edit
$(document).on("change", "#upload_foto", function (e) {
  e.preventDefault();
  var fileName = e.target.files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});
// End Script untuk menampilkan data upload yang ada di form tambah dan edit

// Script untuk menampilkan data file lampiran
$(document).ready(function () {
  // Listen for changes on the file input
  $("#lampiran").on("change", function () {
    // Get the file name
    var fileName = $(this).val().split("\\").pop();
    // Update the label text with the file name
    $(this).next(".custom-file-label").html(fileName);
  });
});
// End Script untuk menampilkan data file lampiran

// Script untuk menampilkan data file_path
$(document).ready(function () {
  // Listen for changes on the file input
  $("#file_path").on("change", function () {
    // Get the file name
    var fileName = $(this).val().split("\\").pop();
    // Update the label text with the file name
    $(this).next(".custom-file-label").html(fileName);
  });
});
// End Script untuk menampilkan data file_path

// Script untuk menampilkan data foto_profile
$(document).ready(function () {
  // Listen for changes on the file input
  $("#foto_profile").on("change", function () {
    // Get the file name
    var fileName = $(this).val().split("\\").pop();
    // Update the label text with the file name
    $(this).next(".custom-file-label").html(fileName);
  });
});
// End Script untuk menampilkan data foto_profile

// Membuat delay alert
$(document).ready(function () {
  // Menghilangkan alert setelah 3 detik
  setTimeout(function () {
    $(".alert").fadeOut();
  }, 3500);
});
// End Membuat delay alert

// Script pencarian table
$(document).ready(function () {
  const $tableSearch = $("#tableSearch");
  const $table = $("#example1");
  const $tbody = $table.find("tbody");
  const $rows = $tbody.find("tr");

  $tableSearch.on("keyup", function () {
    const filter = $tableSearch.val().toLowerCase();

    $rows.each(function () {
      const $row = $(this);
      const $cells = $row.find("td");
      let match = false;

      $cells.each(function () {
        const $cell = $(this);
        if ($cell.text().toLowerCase().includes(filter)) {
          match = true;
          return false; // Berhenti melakukan perulangan
        }
      });

      if (match) {
        $row.show();
      } else {
        $row.hide();
      }
    });
  });
});
// End script pencarian table
