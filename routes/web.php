<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/documentation', [PageController::class, 'documentation'])->name('documentation');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes - Require Authentication
Route::middleware('auth')->group(function () {
    // Admin Routes - Only accessible by admin users
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
        Route::post('/admin/santri', [AdminController::class, 'storeSantri'])->name('admin.santri.store');
        Route::post('/admin/attendance', [AdminController::class, 'storeAttendance'])->name('admin.attendance.store');
        Route::get('/admin/attendance/{attendance}', [AdminController::class, 'getAttendance'])->name('admin.attendance.show');
        Route::post('/admin/attendance/{attendance}/approve', [AdminController::class, 'approveAttendance'])->name('admin.attendance.approve');
        Route::post('/admin/attendance/{attendance}/reject', [AdminController::class, 'rejectAttendance'])->name('admin.attendance.reject');
        Route::put('/admin/attendance/{attendance}', [AdminController::class, 'updateAttendance'])->name('admin.attendance.update');
        Route::post('/admin/finance', [AdminController::class, 'storeFinance'])->name('admin.finance.store');
        Route::post('/admin/guru', [AdminController::class, 'storeGuru'])->name('admin.guru.store');
        Route::post('/admin/material', [AdminController::class, 'storeMaterial'])->name('admin.material.store');
        Route::post('/admin/schedule', [AdminController::class, 'storeSchedule'])->name('admin.schedule.store');
        Route::post('/admin/announcement', [AdminController::class, 'storeAnnouncement'])->name('admin.announcement.store');
        Route::post('/admin/post', [AdminController::class, 'storePost'])->name('admin.post.store');
        Route::post('/admin/post/update', [AdminController::class, 'updatePost'])->name('admin.post.update');
        Route::post('/admin/logo', [AdminController::class, 'updateLogo'])->name('admin.logo.update');
        Route::post('/admin/documentation', [AdminController::class, 'storeDocumentation'])->name('admin.documentation.store');
        Route::post('/admin/user', [AdminController::class, 'updateUser'])->name('admin.user.update');
        Route::post('/admin/invitation', [AdminController::class, 'storeInvitation'])->name('admin.invitation.store');
        Route::get('/admin/finance/export/csv', [AdminController::class, 'exportFinanceCsv'])->name('admin.finance.export.csv');
        Route::get('/admin/finance/export/pdf', [AdminController::class, 'exportFinancePdf'])->name('admin.finance.export.pdf');

        // Data Management Routes
        Route::get('/admin/data/santri', [PageController::class, 'dataSantri'])->name('data-santri');
        Route::get('/admin/data/santri/{user}/edit', [PageController::class, 'editSantri'])->name('edit-santri');
        Route::put('/admin/data/santri/{user}', [PageController::class, 'updateSantri'])->name('update-santri');
        Route::delete('/admin/data/santri/{user}', [PageController::class, 'deleteSantri'])->name('delete-santri');

        Route::get('/admin/data/guru', [PageController::class, 'dataGuru'])->name('data-guru');
        Route::get('/admin/data/guru/{user}/edit', [PageController::class, 'editGuru'])->name('edit-guru');
        Route::put('/admin/data/guru/{user}', [PageController::class, 'updateGuru'])->name('update-guru');
        Route::delete('/admin/data/guru/{user}', [PageController::class, 'deleteGuru'])->name('delete-guru');

        Route::get('/admin/data/user', [PageController::class, 'dataUser'])->name('data-user');
        Route::get('/admin/data/user/create', [PageController::class, 'createUser'])->name('admin.user.create');
        Route::get('/admin/data/user/{user}/edit', [PageController::class, 'editUser'])->name('edit-user');
        Route::put('/admin/data/user/{user}', [PageController::class, 'updateUser'])->name('update-user');
        Route::delete('/admin/data/user/{user}', [PageController::class, 'deleteUser'])->name('delete-user');

        Route::get('/admin/data/keuangan', [PageController::class, 'dataKeuangan'])->name('data-keuangan');
        Route::get('/admin/data/keuangan/{transaction}/edit', [PageController::class, 'editKeuangan'])->name('edit-keuangan');
        Route::put('/admin/data/keuangan/{transaction}', [PageController::class, 'updateKeuangan'])->name('update-keuangan');
        Route::delete('/admin/data/keuangan/{transaction}', [PageController::class, 'deleteKeuangan'])->name('delete-keuangan');

        Route::get('/admin/data/wali-santri', [PageController::class, 'dataWaliSantri'])->name('data-wali-santri');
        Route::get('/admin/data/wali-santri/create', [PageController::class, 'createWaliSantri'])->name('admin.wali.create');
        Route::get('/admin/data/wali-santri/{user}/edit', [PageController::class, 'editWaliSantri'])->name('edit-wali');
        Route::put('/admin/data/wali-santri/{user}', [PageController::class, 'updateWaliSantri'])->name('update-wali');
        Route::delete('/admin/data/wali-santri/{user}', [PageController::class, 'deleteWaliSantri'])->name('delete-wali');

        Route::get('/admin/data/peralatan', [PageController::class, 'dataPeralatan'])->name('data-peralatan');
        Route::get('/admin/data/peralatan/{equipment}/edit', [PageController::class, 'editPeralatan'])->name('edit-peralatan');
        Route::put('/admin/data/peralatan/{equipment}', [PageController::class, 'updatePeralatan'])->name('update-peralatan');
        Route::delete('/admin/data/peralatan/{equipment}', [PageController::class, 'deletePeralatan'])->name('delete-peralatan');

        // Documentation / Asset management
        Route::get('/admin/data/assets', [PageController::class, 'dataAssets'])->name('data-assets');
        Route::get('/admin/data/assets/create', [PageController::class, 'createAsset'])->name('create-asset');
        Route::post('/admin/data/assets', [PageController::class, 'storeAsset'])->name('store-asset');
        Route::get('/admin/data/assets/{asset}/edit', [PageController::class, 'editAsset'])->name('edit-asset');
        Route::put('/admin/data/assets/{asset}', [PageController::class, 'updateAsset'])->name('update-asset');
        Route::delete('/admin/data/assets/{asset}', [PageController::class, 'deleteAsset'])->name('delete-asset');
        Route::get('/admin/data/assets/{asset}/download', [PageController::class, 'downloadAsset'])->name('download-asset');
        Route::get('/admin/data/assets/{asset}/versions/{version}/download', [PageController::class, 'downloadAssetVersion'])->name('download-asset-version');
        Route::post('/admin/data/assets/{asset}/versions/{version}/rollback', [PageController::class, 'rollbackAssetVersion'])->name('rollback-asset-version');

        Route::get('/admin/data/ebook', [PageController::class, 'dataEbooks'])->name('data-ebooks');
        Route::get('/admin/data/calendar', [PageController::class, 'dataCalendar'])->name('data-calendar');
        Route::get('/admin/raport', [PageController::class, 'raport'])->name('raport');
        Route::get('/admin/prestasi', [PageController::class, 'prestasi'])->name('prestasi');

        Route::post('/admin/wali', [AdminController::class, 'storeWali'])->name('admin.wali.store');
        Route::post('/admin/user/create', [AdminController::class, 'storeUser'])->name('admin.user.store');

        Route::get('/admin/tpq-profile/edit', [PageController::class, 'editTpqProfile'])->name('edit-tpq-profile');
        Route::put('/admin/tpq-profile', [PageController::class, 'updateTpqProfile'])->name('update-tpq-profile');

            // API routes related to admin are defined here. (Public TPQ settings route moved below.)
            Route::post('/admin/tpq-logo/remove', [PageController::class, 'removeTpqLogo'])->name('admin.tpq-logo.remove');

        Route::get('/admin/contact-us/manage', [PageController::class, 'editContactUs'])->name('edit-contact-us');
        Route::post('/admin/contact-us', [PageController::class, 'storeContactMessage'])->name('store-contact-message');
        Route::get('/admin/contact-us/{message}/edit', [PageController::class, 'editContactMessage'])->name('edit-contact-message');
        Route::put('/admin/contact-us/{message}', [PageController::class, 'updateContactMessage'])->name('update-contact-message');
        Route::delete('/admin/contact/{message}', [PageController::class, 'deleteContactMessage'])->name('delete-contact-message');
    });

    Route::get('/organization', [PageController::class, 'organization'])->name('organization');
    Route::get('/finance', [PageController::class, 'finance'])->name('finance');
    
    // Restricted pages - Not accessible by wali santri
    Route::middleware('not.wali')->group(function () {
        Route::get('/santri', [PageController::class, 'santri'])->name('santri');
        Route::get('/evaluation', [PageController::class, 'evaluation'])->name('evaluation');
        Route::get('/new-santri', [PageController::class, 'newSantri'])->name('new-santri');
    });

    Route::get('/teachers', [PageController::class, 'teachers'])->name('teachers');
    Route::get('/forum', [PageController::class, 'forum'])->name('forum');
    Route::get('/forum/{topic}', [PageController::class, 'topic'])->name('forum.topic');
    Route::post('/forum', [PageController::class, 'storeForumTopic'])->name('forum.store');
    Route::post('/forum/{topic}/reply', [PageController::class, 'storeForumReply'])->name('forum.reply.store');
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    Route::put('/profile', [PageController::class, 'updateProfile'])->name('profile.update');
    Route::get('/notifications', [PageController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{notification}/read', [PageController::class, 'markNotificationRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [PageController::class, 'markAllNotificationsRead'])->name('notifications.read-all');
});

Route::get('/profil-tpq', [PageController::class, 'tpqProfile'])->name('tpq.profile');
Route::get('/ebook', [PageController::class, 'ebook'])->name('ebook');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendContact'])->name('contact.send');

// Public API for TPQ settings (read-only)
Route::get('/api/tpq-settings', [PageController::class, 'apiTpqSettings'])->name('api.tpq-settings');
