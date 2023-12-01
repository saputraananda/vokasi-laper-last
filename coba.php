<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <title>Menu Makanan</title>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Budget Saya</h2>
  <div class="row">
    <div class="col-md-6">
      <form id="budgetForm">
        <div class="form-group">
          <label for="saldo">Saldo:</label>
          <input type="text" class="form-control" id="saldo" placeholder="Masukkan saldo" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="updateBudget()">Update Budget</button>
      </form>
    </div>
  </div>

  <h2 class="mt-4">Menu Makanan</h2>
  <table class="table table-bordered" id="menuTable">
    <thead>
      <tr>
        <th>Nama Makanan</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nasi Goreng</td>
        <td>Makan Siang</td>
        <td data-price="25000">Rp 25,000</td>
        <td>
          <button class="btn btn-info btn-sm" onclick="viewMenu()">Lihat</button>
          <button class="btn btn-warning btn-sm" onclick="editMenu()">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteMenu()">Hapus</button>
        </td>
      </tr>
      <tr>
        <td>Mie Goreng</td>
        <td>Makan Siang</td>
        <td data-price="20000">Rp 20,000</td>
        <td>
          <button class="btn btn-info btn-sm" onclick="viewMenu()">Lihat</button>
          <button class="btn btn-warning btn-sm" onclick="editMenu()">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteMenu()">Hapus</button>
        </td>
      </tr>
      <tr>
        <td>Roti Bakar</td>
        <td>Sarapan</td>
        <td data-price="15000">Rp 15,000</td>
        <td>
          <button class="btn btn-info btn-sm" onclick="viewMenu()">Lihat</button>
          <button class="btn btn-warning btn-sm" onclick="editMenu()">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteMenu()">Hapus</button>
        </td>
      </tr>
      <tr>
        <td>Ayam Bakar</td>
        <td>Makan Malam</td>
        <td data-price="30000">Rp 30,000</td>
        <td>
          <button class="btn btn-info btn-sm" onclick="viewMenu()">Lihat</button>
          <button class="btn btn-warning btn-sm" onclick="editMenu()">Edit</button>
          <button class="btn btn-danger btn-sm" onclick="deleteMenu()">Hapus</button>
        </td>
      </tr>
    </tbody>
  </table>

  <table class="table mt-4">
    <thead>
      <tr>
        <th>Total Harga</th>
        <th>Saldo Saya</th>
        <th>Sisa Saldo</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td id="totalHargaBudget">Rp 0</td>
        <td id="saldoSaya">Rp 0</td>
        <td id="sisaSaldo">Rp 0</td>
        <td id="status"></td>
      </tr>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    var table = $('#menuTable').DataTable();

    // Update total harga saat tabel diubah
    table.on('draw', function () {
      var total = 0;
      table.column(2, { search: 'applied' }).data().each(function (value) {
        total += parseInt(value.replace('Rp ', '').replace(',', ''));
      });

      $('#totalHargaBudget').text('Rp ' + total.toLocaleString());
    });
  });

  function updateBudget() {
    var saldo = $('#saldo').val();
    var totalHarga = parseInt($('#totalHargaBudget').text().replace('Rp ', '').replace(',', ''));

    $('#saldoSaya').text('Rp ' + saldo.toLocaleString());

    var sisaSaldo = saldo - totalHarga;
    $('#sisaSaldo').text('Rp ' + sisaSaldo.toLocaleString());

    if (totalHarga > saldo) {
      $('#status').text('Saldo tidak mencukupi!');
    } else {
      $('#status').text('Saldo mencukupi');
    }
  }

  function viewMenu() {
    alert('Menu di klik untuk dilihat.');
  }

  function editMenu() {
    alert('Menu di klik untuk diedit.');
  }

  function deleteMenu() {
    alert('Menu di klik untuk dihapus.');
  }
</script>

</body>
</html>
