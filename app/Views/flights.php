<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    form {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    form label {
        font-weight: bold;
    }

    form input[type="date"],
    form input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        flex: 1;
        margin-right: 10px;
    }

    form button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .cust-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
    }

    table th,
    table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th a {
        text-decoration: none;
        color: #333;
    }

    table th a:hover {
        color: #007bff;
    }

    table tbody tr:hover {
        background-color: #f0f0f0;
    }

    div.pagination {
        text-align: center;
        margin-bottom: 20px;
    }

    div.pagination a {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 4px;
        margin-right: 5px;
    }

    div.pagination a:hover {
        background-color: #007bff;
        color: white;
    }

    .custom-toast {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1050;
        width: 300px;
    }
</style>

<?php if (isset($error)) { ?>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast show custom-toast" data-bs-autohide="false">
        <div class="toast-header d-flex justify-content-between">
            <span class="badge rounded-pill text-bg-warning"><strong>Ups! Something Happened</strong></span>
            <button type="button " class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <strong><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Flight</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" action="/">
                        <div class="row">
                            <div class="mb-3">
                                <label for="planeCode" class="form-label">Airplane Code</label>
                                <input type="text" class="form-control" id="planeCode" name="planeCode">
                            </div>
                            <div class="mb-3">
                                <label for="flightDate" class="form-label">Flight Date</label>
                                <input type="date" class="form-control" id="flightDate" name="flightDate">
                            </div>
                            <div class="mb-3">
                                <label for="hour" class="form-label">Flight Time</label>
                                <input type="text" class="form-control" id="hour" name="hour">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="type">
                                    <option selected>Select the Flight Type</option>
                                    <option value="1">Direct Flight</option>
                                    <option value="2">Stopover Flight</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">Total Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost">
                            </div>
                            <div class="mb-3">
                                <label for="hour" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Flight</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<h1>Flights</h1>

<div class="container mt-5 mt-y p-3">
    <button class="cust-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
        New Flight
    </button>
</div>

<form method="get" action="/flights">
    <div class="container">
        <div class="row">
            <div class="row col">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($_GET['date'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="row col">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control">
                    <option selected>Select the Flight Type</option>
                    <option value="1">Direct Flight</option>
                    <option value="2">Stopover Flight</option>
                </select>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button type="submit" style="min-width: 44%;">Filter</button>
            </div>
        </div>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th><a href="?sort=date&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Date</a></th>
            <th><a href="?sort=type&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Type</a></th>
            <th><a href="?sort=cost&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Cost</a></th>
            <th><a href="?sort=cost&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Destiny</a></th>
            <th><a href="?sort=cost&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Hours</a></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($flights as $flight) : ?>
            <tr>
                <td><?php echo htmlspecialchars($flight['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['tipo'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['costo'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['hora'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination">
    <?php for ($i = 1; $i <= ceil(count($flights) / $limit); $i++) : ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>