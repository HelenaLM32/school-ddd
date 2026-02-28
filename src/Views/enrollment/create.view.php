<?php include __DIR__ . '/../layout_open.php'; ?>

<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

      <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-primary text-white">
          <h3 class="mb-0">Matricular Alumne</h3>
        </div>
        <div class="card-body">
          <form action="/enrollment/store" method="POST">
            <div class="mb-3">
              <label class="form-label" for="student_id">Alumne</label>
              <select id="student_id" name="student_id" class="form-select" required>
                <option value="">-- Selecciona un alumne --</option>
                <?php foreach ($students ?? [] as $s): ?>
                <option value="<?= htmlspecialchars($s->id()->value()) ?>">
                  <?= htmlspecialchars($s->name()) ?> (<?= htmlspecialchars($s->email()) ?>)
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="subject_id">Assignatura</label>
              <select id="subject_id" name="subject_id" class="form-select" required>
                <option value="">-- Selecciona una assignatura --</option>
                <?php foreach ($subjects ?? [] as $s): ?>
                <option value="<?= htmlspecialchars($s->id()->value()) ?>">
                  <?= htmlspecialchars($s->name()) ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Matricular</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="/" class="btn btn-link mt-3">← Tornar a l'inici</a>
        </div>
      </div>

      <!-- Resum de matrícules actuals -->
      <?php if (!empty($subjects)): ?>
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Matrícules per assignatura</h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
              <tr><th>Assignatura</th><th class="text-center">Alumnes</th></tr>
            </thead>
            <tbody>
              <?php foreach ($subjects as $sub): ?>
              <tr>
                <td><?= htmlspecialchars($sub->name()) ?></td>
                <td class="text-center">
                  <span class="badge bg-primary"><?= count($sub->enrolledStudentIds()) ?></span>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</main>

<?php include __DIR__ . '/../layout_close.php'; ?>
