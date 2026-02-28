<?php include __DIR__ . '/../layout_open.php'; ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

      <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-primary text-white">
          <h3 class="mb-0">Crear Curs</h3>
        </div>
        <div class="card-body">
          <form action="/course/store" method="POST">
            <div class="mb-3">
              <label class="form-label" for="name">Nom del curs</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="1r ESO A" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="/" class="btn btn-link mt-3">← Tornar a l'inici</a>
        </div>
      </div>

      <?php if (!empty($courses)): ?>
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Cursos registrats</h5>
          <span class="badge bg-light text-dark"><?= count($courses) ?></span>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
              <tr><th>#</th><th>Nom</th><th>ID</th></tr>
            </thead>
            <tbody>
              <?php foreach ($courses as $i => $c): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($c->name()) ?></td>
                <td><code><?= htmlspecialchars($c->id()->value()) ?></code></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php else: ?>
      <div class="alert alert-info">Encara no hi ha cursos registrats.</div>
      <?php endif; ?>

    </div>
  </div>
</main>

<?php include __DIR__ . '/../layout_close.php'; ?>
