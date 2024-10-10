<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\LuaranTugas;
use App\Models\PerjalananDinas;
use App\Models\Rapat;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard.index', function (BreadcrumbTrail $trail) {
  $trail->push('Dashboard', route('dashboard.index'));
});

// show
Breadcrumbs::for('kinerja.show', function (BreadcrumbTrail $trail, $pegawai) {
  $trail->parent('dashboard.index');
  $trail->push('Kinerja Pegawai', route('kinerja.show', $pegawai));
});