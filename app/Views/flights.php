<?php include __DIR__ . '/partials/header.php'; ?>

<h1>Flights</h1>

<form method="get" action="/flights">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($_GET['date'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($_GET['type'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

    <button type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th><a href="?sort=date&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Date</a></th>
            <th><a href="?sort=type&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Type</a></th>
            <th><a href="?sort=cost&order=<?php echo $_GET['order'] === 'ASC' ? 'DESC' : 'ASC'; ?>">Cost</a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($flights as $flight) : ?>
            <tr>
                <td><?php echo htmlspecialchars($flight['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['type'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($flight['cost'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
    <?php for ($i = 1; $i <= ceil($total / $limit); $i++) : ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>