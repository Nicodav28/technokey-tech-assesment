    <link rel="stylesheet" href="css/flights.css">

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

    <?php include __DIR__ . '/layouts/modales.php'; ?>

    <h1>Flights</h1>

    <div class="container mt-5 mt-y p-3">
        <button class="cust-button" data-bs-toggle="modal" data-bs-target="#createRecordMod">
            New Flight
        </button>
    </div>

    <form method="get" action="/">
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
                <th><a href="?sort=fecha&order=<?php echo ($sort === 'fecha' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Record ID</a></th>
                <th><a href="?sort=fecha&order=<?php echo ($sort === 'fecha' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Airplane Code</a></th>
                <th><a href="?sort=fecha&order=<?php echo ($sort === 'fecha' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Date</a></th>
                <th><a href="?sort=tipo&order=<?php echo ($sort === 'tipo' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Flight Time</a></th>
                <th><a href="?sort=costo&order=<?php echo ($sort === 'costo' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Type</a></th>
                <th><a href="?sort=destino&order=<?php echo ($sort === 'destino' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Total Cost</a></th>
                <th><a href="?sort=hora&order=<?php echo ($sort === 'hora' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Destination</a></th>
                <th><a>Actions</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flights as $flight) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($flight['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($flight['codigo_avion'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($flight['fecha'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($flight['hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php switch (htmlspecialchars($flight['tipo'], ENT_QUOTES, 'UTF-8')) {
                            case '1':
                                echo 'Direct Flight';
                                break;
                            case '2':
                                echo 'Stopover Flight';
                                break;
                            default:
                                echo 'N/A';
                                break;
                        } ?></td>
                    <td><?php echo htmlspecialchars($flight['costo'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($flight['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="fetchFlightData(<?php echo $flight['id']; ?>)">Update</button>
                        <button type="button" class="btn btn-danger" onclick="deleteFlight(<?php echo $flight['id']; ?>);">Delete</button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class=" pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
    </script>