<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\DocumentationMedia;
use App\Models\FinanceTransaction;
use App\Models\InvitationLetter;
use App\Models\LessonSchedule;
use App\Models\Post;
use App\Models\Role;
use App\Models\SubjectMaterial;
use App\Models\User;
use App\Models\ContactMessage;
use App\Models\Notification;
use App\Models\TpqSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(): \Illuminate\View\View
    {
        $today = Carbon::today();
        $kpiLabels = [];
        $kpiData = [];

        for ($i = 5; $i >= 0; $i--) {
            $period = $today->copy()->subMonths($i);
            $kpiLabels[] = $period->format('M');
            $kpiData[] = User::whereMonth('created_at', $period->month)
                ->whereYear('created_at', $period->year)
                ->count();
        }

        return view('pages.admin', [
            'totalUsers' => Schema::hasTable('users') ? User::count() : 0,
            'totalRoles' => Schema::hasTable('roles') ? Role::count() : 0,
            'guruCount' => Schema::hasTable('roles') && Schema::hasTable('role_user') ? User::whereHas('roles', fn ($q) => $q->where('slug', 'guru'))->count() : 0,
            'santriCount' => Schema::hasTable('roles') && Schema::hasTable('role_user') ? User::whereHas('roles', fn ($q) => $q->where('slug', 'santri'))->count() : 0,
            'classroomCount' => Schema::hasTable('classrooms') ? Classroom::count() : 0,
            'attendanceToday' => Schema::hasTable('attendances') ? Attendance::where('date', $today->toDateString())->count() : 0,
            'monthlyIncome' => Schema::hasTable('finance_transactions') ? FinanceTransaction::where('type', 'income')->whereMonth('transaction_date', $today)->sum('amount') : 0,
            'monthlyExpense' => Schema::hasTable('finance_transactions') ? FinanceTransaction::where('type', 'expense')->whereMonth('transaction_date', $today)->sum('amount') : 0,
            'guardianNotifications' => Schema::hasTable('attendances') ? Attendance::where('guardian_notified', true)->latest()->limit(5)->get() : collect(),
            'kpiLabels' => $kpiLabels,
            'kpiData' => $kpiData,
            'teachers' => Schema::hasTable('roles') && Schema::hasTable('role_user') ? User::whereHas('roles', fn ($q) => $q->where('slug', 'guru'))->get() : collect(),
            'materials' => Schema::hasTable('subject_materials') ? SubjectMaterial::latest()->limit(8)->get() : collect(),
            'materialsCount' => Schema::hasTable('subject_materials') ? SubjectMaterial::count() : 0,
            'schedules' => Schema::hasTable('lesson_schedules') ? LessonSchedule::latest()->limit(8)->get() : collect(),
            'schedulesCount' => Schema::hasTable('lesson_schedules') ? LessonSchedule::count() : 0,
            'appointments' => Schema::hasTable('invitation_letters') ? InvitationLetter::latest()->limit(5)->get() : collect(),
            'appointmentsCount' => Schema::hasTable('invitation_letters') ? InvitationLetter::count() : 0,
            'recentTransactions' => Schema::hasTable('finance_transactions') ? FinanceTransaction::orderByDesc('transaction_date')->limit(5)->get() : collect(),
            'tpqSettings' => Schema::hasTable('tpq_settings') ? TpqSetting::pluck('value','key')->all() : [],
            'posts' => Schema::hasTable('posts') ? Post::latest()->limit(10)->get() : collect(),
            'documentationMedia' => Schema::hasTable('documentation_media') ? DocumentationMedia::latest()->limit(8)->get() : collect(),
            'messages' => Schema::hasTable('contact_messages') ? ContactMessage::latest()->limit(8)->get() : collect(),
            'issueReports' => Schema::hasTable('contact_messages') ? ContactMessage::where('subject', 'like', '%lapor%')->orWhere('subject', 'like', '%masalah%')->latest()->limit(8)->get() : collect(),
            'notifications' => Auth::user()->notifications()->limit(8)->get(),
            'unreadNotificationCount' => Auth::user()->unreadNotifications()->count(),
            'teacherAttendances' => Schema::hasTable('attendances') ? Attendance::with('user')->latest()->limit(20)->get() : collect(),
            'pendingTeacherAttendances' => Schema::hasTable('attendances') ? Attendance::with('user')->where('status', 'pending')->latest()->get() : collect(),
            'studentAttendanceToday' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('date', $today->toDateString())->count() : 0,
            'studentAttendanceTotal' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->count() : 0,
            'studentPresentCount' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('status','present')->count() : 0,
            'studentAbsentCount' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('status','absent')->count() : 0,
            'studentLateCount' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('status','late')->count() : 0,
            'studentPermissionCount' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('status','permission')->count() : 0,
            'studentPendingCount' => Schema::hasTable('attendances') ? Attendance::whereHas('user.roles', fn ($q) => $q->where('slug','santri'))->where('status','pending')->count() : 0,
        ]);
    }

        public function approveAttendance(Request $request, Attendance $attendance)
        {
            $attendance->status = 'permission';
            $attendance->guardian_notified = true;
            $attendance->save();

            Notification::createForUser(
                $attendance->user,
                'attendance_approved',
                'Izin absensi Anda disetujui',
                'Pengajuan izin pada tanggal ' . ($attendance->date ? (string)$attendance->date : '') . ' telah disetujui oleh admin.',
                ['attendance_id' => $attendance->id]
            );

            return redirect()->back()->with('success', 'Pengajuan izin berhasil diterima.');
        }

        public function rejectAttendance(Request $request, Attendance $attendance)
        {
            $attendance->status = 'rejected';
            $attendance->guardian_notified = false;
            $attendance->save();

            Notification::createForUser(
                $attendance->user,
                'attendance_rejected',
                'Izin absensi Anda ditolak',
                'Pengajuan izin pada tanggal ' . ($attendance->date ? (string)$attendance->date : '') . ' telah ditolak oleh admin.',
                ['attendance_id' => $attendance->id]
            );

            return redirect()->back()->with('success', 'Pengajuan izin berhasil ditolak.');
        }

        public function updateAttendance(Request $request, Attendance $attendance)
        {
            $request->validate([
                'date' => 'required|date',
                'status' => 'required|in:present,absent,late,pending,permission,rejected',
                'note' => 'nullable|string',
            ]);

            $attendance->date = $request->date;
            $attendance->status = $request->status;
            $attendance->note = $request->note;
            $attendance->save();

            return redirect()->back()->with('success', 'Absensi berhasil diperbarui.');
        }

        public function getAttendance(Attendance $attendance)
        {
            $attendance->load('user');
            $data = $attendance->toArray();
            // Ensure date is Y-m-d for form population
            $data['date_iso'] = $attendance->date ? (string)$attendance->date : null;
            return response()->json($data);
        }

    public function storeSantri(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'guardian_id' => 'required|exists:users,id',
            'email' => 'nullable|string|email|max:255|unique:users,email',
        ]);

        $username = Str::slug($request->nickname, '_');
        $originalUsername = $username;
        $count = 1;
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . '_' . $count++;
        }

        $birthDate = Carbon::parse($request->birth_date);
        $guardian = User::find($request->guardian_id);

        $user = User::create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'username' => $username,
            'email' => $request->email,
            'birth_place' => $request->birth_place,
            'birth_date' => $birthDate->toDateString(),
            'age' => $birthDate->diffInYears(Carbon::now()),
            'guardian_id' => $request->guardian_id,
            'address' => $guardian?->address,
            'password' => Hash::make($username . $birthDate->format('Y')),
        ]);

        $role = Role::where('slug', 'santri')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        Notification::createForAdmins(
            'new_santri',
            'Santri baru ditambahkan',
            'Santri baru ' . $user->name . ' telah ditambahkan oleh admin.',
            ['user_id' => $user->id]
        );

        return redirect()->back()->with('success', 'Data santri baru berhasil disimpan.');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late,pending',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_contact' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        Attendance::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'status' => $request->status,
            'note' => $request->note,
            'guardian_name' => $request->guardian_name,
            'guardian_contact' => $request->guardian_contact,
            'guardian_notified' => $request->status !== 'present',
        ]);

        return redirect()->back()->with('success', 'Absensi guru berhasil direkam.');
    }

    public function storeFinance(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        FinanceTransaction::create($request->only(['type', 'amount', 'category', 'description', 'transaction_date']));

        return redirect()->back()->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'nullable|string|email|max:255|unique:users,email',
            'specialty' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        $username = $request->username ?: Str::slug($request->name, '_') . '_' . time();
        $email = $request->email ?: 'guru+' . time() . '@example.com';

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make(Str::random(12)),
        ]);

        $role = Role::where('slug', 'guru')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        Notification::createForAdmins(
            'new_guru',
            'Guru baru ditambahkan',
            'Guru baru ' . $user->name . ' telah ditambahkan oleh admin.',
            ['user_id' => $user->id]
        );

        Classroom::create([
            'name' => $request->specialty ?: 'Kelas Baru',
            'teacher_id' => $user->id,
            'description' => $request->contact,
        ]);

        return redirect()->back()->with('success', 'Data guru berhasil disimpan.');
    }

    public function storeWali(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',
        ]);

        $username = $request->username ?: Str::slug($request->name, '_') . '_' . time();

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(12)),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $role = Role::where('slug', 'wali-santri')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        Notification::createForAdmins(
            'new_wali',
            'Wali santri baru ditambahkan',
            'Wali santri baru ' . $user->name . ' telah ditambahkan oleh admin.',
            ['user_id' => $user->id]
        );

        return redirect()->back()->with('success', 'Data wali santri berhasil disimpan.');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|string|exists:roles,slug',
        ]);

        $username = $request->username ?: Str::slug($request->name, '_') . '_' . time();

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(12)),
        ]);

        $role = Role::where('slug', $request->role)->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        Notification::createForAdmins(
            'new_user',
            'User baru ditambahkan',
            'User baru ' . $user->name . ' telah ditambahkan oleh admin.',
            ['user_id' => $user->id]
        );

        return redirect()->back()->with('success', 'Data user berhasil disimpan.');
    }

    public function storeMaterial(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        SubjectMaterial::create($request->only(['title', 'category', 'description']));

        return redirect()->back()->with('success', 'Materi pelajaran berhasil ditambahkan.');
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'day' => 'required|string|max:50',
            'time' => 'required|string|max:80',
            'group' => 'nullable|string|max:255',
            'activity' => 'required|string|max:255',
        ]);

        LessonSchedule::create($request->only(['day', 'time', 'group', 'activity']));

        return redirect()->back()->with('success', 'Jadwal kegiatan berhasil ditambahkan.');
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'title' => $request->title,
            'content' => $request->get('content'),
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublikasikan.');
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->get('content'),
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Postingan berhasil dibuat.');
    }

    public function updatePost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($request->post_id);
        $post->update([
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->get('content'),
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Postingan blog berhasil diperbarui.');
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $uploadDir = public_path('uploads');
        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $request->file('logo')->move($uploadDir, 'logo.png');

        return redirect()->back()->with('success', 'Logo berhasil diperbarui.');
    }

    public function storeDocumentation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'file' => 'required|file|max:10240',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = 'doc_' . time() . '_' . Str::slug($request->title, '_') . '.' . $extension;

        Storage::makeDirectory('public/documentation');
        $filePath = $file->storeAs('public/documentation', $filename);

        DocumentationMedia::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Dokumentasi berhasil diunggah.');
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($request->role) {
            $role = Role::where('slug', $request->role)->first();
            if ($role) {
                $user->roles()->syncWithoutDetaching([$role->id]);
            }
        }

        if ($request->status === 'Nonaktif') {
            $user->email = $user->email . '.disabled';
            $user->save();
        }

        Notification::createForUser(
            $user,
            'data_update',
            'Akun Anda telah diubah',
            'Perubahan peran atau status akun Anda telah dilakukan oleh admin.',
            ['role' => $request->role, 'status' => $request->status]
        );

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }

    public function storeInvitation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'event_date' => 'required|date',
            'body' => 'required|string',
        ]);

        InvitationLetter::create($request->only(['title', 'recipient_name', 'subject', 'event_date', 'body']));

        return redirect()->back()->with('success', 'Surat undangan berhasil disimpan dan siap diekspor.');
    }

    public function exportFinanceCsv()
    {
        $transactions = FinanceTransaction::orderByDesc('transaction_date')->get();

        $csv = "Tipe,Jumlah,Kategori,Deskripsi,Tanggal\n";
        foreach ($transactions as $transaction) {
            $amount = $transaction->amount ?? 0.0;
            $dateStr = $transaction->transaction_date ? (string) $transaction->transaction_date : '';
            $csv .= sprintf(
                '%s,%s,%s,%s,%s\n',
                ucfirst($transaction->type),
                number_format((float) $amount, 2, '.', ','),
                $transaction->category,
                str_replace(["\n", "\r"], [' ', ' '], $transaction->description),
                $dateStr
            );
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan-keuangan.csv"',
        ]);
    }

    public function exportFinancePdf()
    {
        $transactions = FinanceTransaction::orderByDesc('transaction_date')->get();
        return response()->view('pages.finance-export', compact('transactions'));
    }
}
