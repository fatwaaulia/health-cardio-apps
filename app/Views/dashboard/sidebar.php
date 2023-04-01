<?php 
$user_session = session()->get('user');
$user = model('M_Users')->where('id', $user_session['id'])->first();
?>

<div class="wrapper">
	<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" href="<?= base_url('dashboard') ?>">
				<img src="<?= base_url().'/assets/img/logo.png' ?>" class="w-100" alt="<?= getenv('app.name') ?>">
			</a>

			<ul class="sidebar-nav">

				<!-- Sidebar Menu -->
				<?php
				$sidebar = [
					// == SEMUA ROLE ==
					[
						'text'    => 'Dashboard',
						'url'     => 'dashboard',
						'icon'    => 'fa-solid fa-house',
						'active'  => 'dashboard',
						'role'    => ['1','2','3'],
					],
					//  ==SUPERADMIN ==
					[
						'text'    => 'Kelola Pengguna',
						'url'     => 'users',
						'icon'    => 'fa-solid fa-user-group',
						'active'  => 'users',
						'role'    => ['1'],
					],
					[
						'text'    => 'Pasien',
						'role'   => ['1'],
					],
					[
						'text'    => 'Screening',
						'url'     => 'screening-pasien',
						'icon'    => 'fa-solid fa-square-poll-vertical',
						'active'  => 'screening-pasien',
						'role'    => ['1'],
					],
					// == PASIEN ==
					[
						'text'    => 'Pemeriksaan',
						'role'    => ['3'],
					],
					[
						'text'    => 'Personal Information',
						'url'     => 'profile',
						'icon'    => 'fa-solid fa-user',
						'active'  => 'profile',
						'role'    => ['3'],
					],
					[
						'text'    => 'Screening',
						'url'     => 'screening',
						'icon'    => 'fa-solid fa-square-poll-vertical',
						'active'  => 'screening',
						'role'    => ['3'],
					],
					[
						'text'    => 'My Diary',
						'url'     => 'my-diary',
						'icon'    => 'fa-solid fa-book',
						'active'  => 'my-diary',
						'role'    => ['3'],
					],
					[
						'text'    => 'Tata Laksana',
						'url'     => 'tata-laksana',
						'icon'    => 'fa-solid fa-timeline',
						'active'  => 'tata-laksana',
						'role'    => ['3'],
					],
					// == SEMUA ROLE ==
					[
						'text'    => 'Akun Saya',
						'role'   => ['1','2','3'],
					],
					[
						'text'    => 'Profil',
						'url'     => 'profile',
						'icon'    => 'fa-solid fa-user',
						'active'  => 'profile',
						'role'    => ['1'],
					],
					[
						'text'    => 'Pengaturan',
						'url'     => 'settings',
						'icon'    => 'fa-solid fa-gear',
						'active'  => 'settings',
						'role'    => ['1','2','3'],
					],
					[
						'text'    => 'Keluar',
						'url'     => 'logout',
						'icon'    => 'fa-solid fa-arrow-right-from-bracket',
						'active'  => '',
						'role'    => ['1','2','3'],
					],

				];
				?>

				<?php 
				$uri_1 = service('uri')->getSegment(1);
				foreach ($sidebar as $v) : 
					// Cek role
					if ( in_array($user['id_role'], $v['role'] )) :
						// Cek url
						if (!empty($v['url'])) {
							if ($uri_1 == $v['active']) {
								$active = 'active';
							} else {
								$active = '';
							}
							?>
							<li class="sidebar-item <?= $active ?>">
								<a class="sidebar-link" href="<?= base_url().'/'.$v['url'] ?>">
									<i class="align-middle <?= $v['icon'] ?>"></i> 
									<span class="align-middle"><?= $v['text'] ?></span>
								</a>
							</li>
					<?php } else { ?>
						<li class="sidebar-header">
							<?= $v['text'] ?>
						</li>
					<?php } ?>
				<?php 
					endif;
				endforeach; 
				?>
		</div>
	</nav>

	<div class="main">
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
			</a>
			<div class="navbar-collapse collapse">
				<ul class="navbar-nav navbar-align">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
							<?php
							if ($user['img']) {
								$img = base_url('assets/img/users/'.$user['img']);
							} else {
								$img = base_url('assets/img/user-default.png');
							}
							?>
							<img src="<?= $img ?>" class="avatar img-fluid img-style rounded-circle me-1" /> 
							<span class="text-dark d-none d-md-inline-block">
								<?= mb_strimwidth($user['nama'], 0, 15, "..."); ?>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="<?= base_url().'/profile' ?>">
								<i class="fa-solid fa-user me-1"></i>
								Profil
							</a>
								<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url().'/logout' ?>">
								<i class="fa-solid fa-arrow-right-from-bracket me-1"></i>
								Keluar
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
