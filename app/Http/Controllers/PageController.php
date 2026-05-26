<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ContactMessage;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\DocumentationMedia;
use App\Models\LessonSchedule;
use App\Models\Equipment;
use App\Models\FinanceTransaction;
use App\Models\ForumReply;
use App\Models\ForumTopic;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Role;
use App\Models\TpqSetting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'santriCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count(),
            'guruCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'))->count(),
            'classroomCount' => Classroom::count(),
            'documentationCount' => DocumentationMedia::count(),
        ]);
    }

    public function dashboard(): View|RedirectResponse
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $role = $this->primaryRole($user);
        if ($role === 'admin') {
            return redirect()->route('admin');
        }

        $data = [
            'role' => $role,
            'roleLabel' => $this->roleLabel($role),
            'commonCounts' => [
                'santri' => User::whereHas('roles', fn ($q) => $q->where('slug', 'santri'))->count(),
                'guru' => User::whereHas('roles', fn ($q) => $q->where('slug', 'guru'))->count(),
                'classrooms' => Classroom::count(),
                'documentation' => DocumentationMedia::count(),
                'announcements' => Announcement::count(),
                'financeTransactions' => FinanceTransaction::count(),
            ],
            'recentAnnouncements' => Announcement::orderByDesc('created_at')->limit(4)->get(),
            'recentSchedules' => LessonSchedule::orderBy('day')->limit(5)->get(),
            'recentNotifications' => Schema::hasTable('notifications') ? $user->notifications()->limit(5)->get() : collect(),
            'unreadNotifications' => Schema::hasTable('notifications') ? $user->unreadNotifications()->count() : 0,
            'teacherClasses' => collect(),
            'userAttendances' => collect(),
            'guardianAttendances' => collect(),
            'attendanceSummary' => [
                'present' => 0,
                'absent' => 0,
                'late' => 0,
                'total' => 0,
            ],
            'associatedStudentsCount' => 0,
        ];

        if ($role === 'guru') {
            $teacherClasses = Classroom::where('teacher_id', $user->id)->get();
            $data['teacherClasses'] = $teacherClasses;
            $data['classesCount'] = $teacherClasses->count();
        }

        if ($role === 'santri') {
            $userAttendances = Attendance::where('user_id', $user->id)->latest('date')->limit(5)->get();
            $data['userAttendances'] = $userAttendances;
            $data['attendanceSummary'] = [
                'present' => Attendance::where('user_id', $user->id)->where('status', 'present')->count(),
                'absent' => Attendance::where('user_id', $user->id)->where('status', 'absent')->count(),
                'late' => Attendance::where('user_id', $user->id)->where('status', 'late')->count(),
                'total' => Attendance::where('user_id', $user->id)->count(),
            ];
        }

        if ($role === 'wali-santri') {
            $guardianAttendances = Attendance::where(function ($query) use ($user) {
                $query->where('guardian_name', $user->name);
                if (! empty($user->email)) {
                    $query->orWhere('guardian_contact', $user->email);
                }
            })->latest('date')->limit(5)->get();

            $data['guardianAttendances'] = $guardianAttendances;
            $data['associatedStudentsCount'] = $guardianAttendances->pluck('user_id')->unique()->count();
        }

        if ($role === 'bendahara') {
            $data['financeSummary'] = [
                'totalAmount' => FinanceTransaction::sum('amount'),
                'incomeCount' => FinanceTransaction::count(),
            ];
        }

        if (in_array($role, ['guru', 'santri', 'wali-santri'], true)) {
            $data['recentSchedules'] = LessonSchedule::limit(5)->get();
        }

        return view('pages.dashboard', $data);
    }

    protected function primaryRole(User $user): string
    {
        $roles = ['admin', 'bendahara', 'guru', 'wali-santri', 'santri', 'pembina', 'penanggung-jawab', 'ketua', 'sekretaris', 'tamu'];

        foreach ($roles as $slug) {
            if ($user->hasRole($slug)) {
                return $slug;
            }
        }

        return 'tamu';
    }

    protected function roleLabel(string $role): string
    {
        return match ($role) {
            'bendahara' => 'Bendahara',
            'guru' => 'Guru',
            'wali-santri' => 'Wali Santri',
            'santri' => 'Santri',
            'pembina' => 'Pembina',
            'penanggung-jawab' => 'Penanggung Jawab',
            'ketua' => 'Ketua',
            'sekretaris' => 'Sekretaris',
            'admin' => 'Administrator',
            default => 'Pengguna',
        };
    }

    public function blog(): View
    {
        $posts = Post::orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.blog', compact('posts'));
    }

    public function documentation(): View
    {
        $media = DocumentationMedia::whereIn('type', ['image', 'video'])
            ->orderByDesc('created_at')
            ->paginate(12);
        return view('pages.documentation', compact('media'));
    }

    public function ebook(): View
    {
        $ebooks = DocumentationMedia::where('type', 'ebook')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('pages.ebook', compact('ebooks'));
    }

    public function admin(): View
    {
        return view('pages.admin', [
            'totalUsers' => User::count(),
            'totalRoles' => Role::count(),
            'guruCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'))->count(),
            'santriCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count(),
            'classroomCount' => Classroom::count(),
            'materialsCount' => DocumentationMedia::count(),
            'schedulesCount' => LessonSchedule::count(),
            'appointmentsCount' => 0,
            'posts' => Post::orderByDesc('created_at')->limit(5)->get(),
            'recentTransactions' => FinanceTransaction::orderByDesc('transaction_date')->limit(5)->get(),
            'pendingRegistrations' => User::whereNull('email_verified_at')->count(),
            'tpqSettings' => TpqSetting::pluck('value','key')->all(),
        ]);
    }

    public function organization(): View
    {
        $roles = Role::withCount('users')
            ->orderByDesc('users_count')
            ->get();

        $leadershipRoles = Role::whereIn('slug', ['admin', 'pembina', 'penanggung-jawab', 'ketua', 'sekretaris', 'bendahara'])
            ->with('users')
            ->get();

        $stats = [
            'staff' => User::whereHas('roles', fn ($query) => $query->whereIn('slug', ['guru', 'bendahara', 'pembina', 'penanggung-jawab', 'ketua', 'sekretaris']))->count(),
            'teachers' => User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'))->count(),
            'students' => User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count(),
            'guardians' => User::whereHas('roles', fn ($query) => $query->where('slug', 'wali-santri'))->count(),
        ];

        return view('pages.organization', compact('roles', 'leadershipRoles', 'stats'));
    }

    public function finance(): View
    {
        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $transactions = FinanceTransaction::orderByDesc('transaction_date')->limit(12)->get();

        return view('pages.finance', compact('totalIncome', 'totalExpense', 'balance', 'transactions'));
    }

    public function santri(): View
    {
        $santri = User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))
            ->orderByDesc('created_at')
            ->get();

        $attendanceSummary = [
            'present' => Attendance::where('status', 'present')->count(),
            'absent' => Attendance::where('status', 'absent')->count(),
            'late' => Attendance::where('status', 'late')->count(),
            'total' => Attendance::count(),
        ];

        return view('pages.santri', compact('santri', 'attendanceSummary'));
    }

    public function teachers(): View
    {
        $teachers = User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'))
            ->orderBy('name')
            ->get();

        $classCounts = Classroom::select('teacher_id', DB::raw('count(*) as total'))
            ->groupBy('teacher_id')
            ->pluck('total', 'teacher_id');

        foreach ($teachers as $teacher) {
            $teacher->class_count = $classCounts->get($teacher->id, 0);
        }

        return view('pages.teachers', compact('teachers'));
    }

    public function evaluation(): View
    {
        $attendanceSummary = [
            'present' => Attendance::where('status', 'present')->count(),
            'absent' => Attendance::where('status', 'absent')->count(),
            'late' => Attendance::where('status', 'late')->count(),
            'total' => Attendance::count(),
        ];

        $recentAttendances = Attendance::with('user')
            ->latest('date')
            ->limit(8)
            ->get();

        $scheduleCount = LessonSchedule::count();
        $topActivities = LessonSchedule::select('activity', DB::raw('count(*) as total'))
            ->groupBy('activity')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('pages.evaluation', compact('attendanceSummary', 'recentAttendances', 'scheduleCount', 'topActivities'));
    }

    public function raport(): View
    {
        $santri = User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))
            ->withCount([
                'attendances as present_count' => fn ($query) => $query->where('status', 'present'),
                'attendances as absent_count' => fn ($query) => $query->where('status', 'absent'),
                'attendances as late_count' => fn ($query) => $query->where('status', 'late'),
                'attendances as permission_count' => fn ($query) => $query->where('status', 'permission'),
                'attendances as pending_count' => fn ($query) => $query->where('status', 'pending'),
            ])
            ->orderByDesc('present_count')
            ->limit(20)
            ->get();

        $reportSummary = [
            'santri' => User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count(),
            'today' => Attendance::where('date', Carbon::today()->toDateString())->count(),
            'present' => Attendance::where('status', 'present')->count(),
            'absent' => Attendance::where('status', 'absent')->count(),
        ];

        return view('pages.raport', compact('santri', 'reportSummary'));
    }

    public function prestasi(): View
    {
        $topStudents = User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))
            ->withCount([
                'attendances as present_count' => fn ($query) => $query->where('status', 'present'),
                'attendances as absent_count' => fn ($query) => $query->where('status', 'absent'),
                'attendances as late_count' => fn ($query) => $query->where('status', 'late'),
            ])
            ->orderByDesc('present_count')
            ->limit(10)
            ->get();

        $santriTotal = User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count();

        $achievementSummary = [
            'verified' => 0,
            'pending' => 0,
        ];

        return view('pages.prestasi', compact('topStudents', 'achievementSummary', 'santriTotal'));
    }

    public function forum(): View
    {
        $topics = ForumTopic::with('user')->orderByDesc('created_at')->get();

        return view('pages.forum', compact('topics'));
    }

    public function storeForumTopic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        ForumTopic::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->input('content'),
            'views_count' => 0,
            'replies_count' => 0,
        ]);

        return redirect()->route('forum')->with('success', 'Topik diskusi berhasil dibuat.');
    }

    public function topic(ForumTopic $topic): View
    {
        $topic->load(['user', 'replies.user']);
        $topic->increment('views_count');

        return view('pages.forum-topic', compact('topic'));
    }

    public function storeForumReply(Request $request, ForumTopic $topic)
    {
        $request->validate([
            'content' => 'required|string|min:5',
        ]);

        ForumReply::create([
            'forum_topic_id' => $topic->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        $topic->increment('replies_count');

        return redirect()->route('forum.topic', $topic)->with('success', 'Balasan berhasil dikirim.');
    }

    public function profile(): View
    {
        return view('pages.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $update = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $update['password'] = Hash::make($request->password);
        }

        User::where('id', $user->id)->update($update);

        $notificationType = $request->filled('password') ? 'password_change' : 'profile_update';
        Notification::createForUser(
            $user,
            $notificationType,
            'Profil berhasil diperbarui',
            'Profil dan data akun Anda telah diperbarui.',
            ['fields' => array_keys($update)]
        );

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function notifications(): View
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        return view('pages.notifications', [
            'notifications' => $user->notifications()->limit(20)->get(),
            'unreadCount' => $user->unreadNotifications()->count(),
        ]);
    }

    public function markNotificationRead(Request $request, Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        if (! $notification->read_at) {
            $notification->update(['read_at' => now()]);
        }

        return back();
    }

    public function markAllNotificationsRead(Request $request)
    {
        $user = Auth::user();
        if (! $user instanceof User) {
            abort(403);
        }

        $user->unreadNotifications()->update(['read_at' => now()]);

        return back();
    }

    public function tpqProfile(): View
    {
        return view('pages.tpq-profile', [
            'santriCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'))->count(),
            'guruCount' => User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'))->count(),
            'classroomCount' => Classroom::count(),
            'tpqSettings' => TpqSetting::pluck('value', 'key')->all(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact-us');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        $subject = strtolower($request->subject);
        $notificationType = str_contains($subject, 'lapor') || str_contains($subject, 'masalah') ? 'issue_report' : 'new_message';
        Notification::createForAdmins(
            $notificationType,
            'Pesan baru diterima',
            'Terdapat pesan baru dari halaman kontak: ' . $request->subject,
            ['contact_message_id' => $message->id]
        );

        return redirect()->route('contact')->with('success', true);
    }

    public function storeContactMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        $subject = strtolower($request->subject);
        $notificationType = str_contains($subject, 'lapor') || str_contains($subject, 'masalah') ? 'issue_report' : 'new_message';
        Notification::createForAdmins(
            $notificationType,
            'Pesan kontak baru',
            'Pesan kontak baru telah ditambahkan: ' . $request->subject,
            ['contact_message_id' => $message->id]
        );

        return redirect()->route('edit-contact-us')->with('success', 'Pesan kontak berhasil ditambahkan.');
    }

    public function editContactMessage(ContactMessage $message): View
    {
        return view('pages.admin-edit-contact-message', ['contactMessage' => $message]);
    }

    public function updateContactMessage(Request $request, ContactMessage $message)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message->update($request->only(['name', 'email', 'phone', 'subject', 'message']));

        Notification::createForAdmins(
            'data_update',
            'Pesan kontak diperbarui',
            'Pesan kontak #' . $message->id . ' telah diperbarui.',
            ['contact_message_id' => $message->id]
        );

        return redirect()->route('edit-contact-us')->with('success', 'Pesan kontak berhasil diperbarui.');
    }

    public function newSantri(): View
    {
        return view('pages.new-santri');
    }

    // ========== Data Management Methods ==========

    public function dataSantri(Request $request): View
    {
        $query = User::whereHas('roles', fn ($query) => $query->where('slug', 'santri'));
        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('username', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }
        $santri = $query->orderByDesc('created_at')->get();
        $guardians = User::whereHas('roles', fn ($query) => $query->where('slug', 'wali-santri'))->orderBy('name')->get();
        return view('pages.admin-data-santri', compact('santri', 'guardians'));
    }

    public function editSantri(User $user): View
    {
        $guardians = User::whereHas('roles', fn ($query) => $query->where('slug', 'wali-santri'))->orderBy('name')->get();
        return view('pages.admin-edit-santri', compact('user', 'guardians'));
    }

    public function updateSantri(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'guardian_id' => 'required|exists:users,id',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $guardian = User::find($request->guardian_id);
        $birthDate = Carbon::parse($request->birth_date);

        $user->update([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'birth_place' => $request->birth_place,
            'birth_date' => $birthDate->toDateString(),
            'age' => $birthDate->diffInYears(Carbon::now()),
            'guardian_id' => $request->guardian_id,
            'address' => $guardian?->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('data-santri')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function deleteSantri(User $user)
    {
        $user->delete();
        return redirect()->route('data-santri')->with('success', 'Data santri berhasil dihapus.');
    }

    public function dataGuru(Request $request): View
    {
        $query = User::whereHas('roles', fn ($query) => $query->where('slug', 'guru'));
        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('username', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }
        $guru = $query->orderByDesc('created_at')->get();
        return view('pages.admin-data-guru', compact('guru'));
    }

    public function editGuru(User $user): View
    {
        return view('pages.admin-edit-guru', compact('user'));
    }

    public function updateGuru(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only(['name', 'email', 'phone']));
        return redirect()->route('data-guru')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function deleteGuru(User $user)
    {
        $user->delete();
        return redirect()->route('data-guru')->with('success', 'Data guru berhasil dihapus.');
    }

    public function dataUser(Request $request): View
    {
        $query = User::query();
        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('username', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }
        $users = $query->orderByDesc('created_at')->get();
        $roles = Role::all();
        return view('pages.admin-data-user', compact('users', 'roles'));
    }

    public function createUser(): View
    {
        $roles = Role::all();
        return view('pages.admin-create-user', compact('roles'));
    }

    public function createWaliSantri(): View
    {
        return view('pages.admin-create-wali');
    }

    public function editUser(User $user): View
    {
        $roles = Role::all();
        return view('pages.admin-edit-user', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($request->only(['name', 'email']));
        $user->roles()->sync([$request->role_id]);
        return redirect()->route('data-user')->with('success', 'Data user berhasil diperbarui.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('data-user')->with('success', 'Data user berhasil dihapus.');
    }

    public function dataKeuangan(Request $request): View
    {
        $query = FinanceTransaction::query();
        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('category', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%')
                    ->orWhere('transaction_date', 'like', '%' . $request->q . '%');
            });
        }
        $transactions = $query->orderByDesc('transaction_date')->get();
        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        return view('pages.admin-data-keuangan', compact('transactions', 'totalIncome', 'totalExpense'));
    }

    public function editKeuangan(FinanceTransaction $transaction): View
    {
        return view('pages.admin-edit-keuangan', compact('transaction'));
    }

    public function updateKeuangan(Request $request, FinanceTransaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($request->only(['type', 'amount', 'category', 'description', 'transaction_date']));
        return redirect()->route('data-keuangan')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    public function deleteKeuangan(FinanceTransaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('data-keuangan')->with('success', 'Data keuangan berhasil dihapus.');
    }

    public function dataWaliSantri(Request $request): View
    {
        $query = User::whereHas('roles', fn ($query) => $query->where('slug', 'wali-santri'));
        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('username', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }
        $guardians = $query->orderByDesc('created_at')->get();
        return view('pages.admin-data-wali', compact('guardians'));
    }

    public function editWaliSantri(User $user): View
    {
        return view('pages.admin-edit-wali', compact('user'));
    }

    public function updateWaliSantri(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address']));
        return redirect()->route('data-wali-santri')->with('success', 'Data wali santri berhasil diperbarui.');
    }

    public function deleteWaliSantri(User $user)
    {
        $user->delete();
        return redirect()->route('data-wali-santri')->with('success', 'Data wali santri berhasil dihapus.');
    }

    public function dataPeralatan(): View
    {
        $equipments = Equipment::orderByDesc('created_at')->get();
        return view('pages.admin-data-peralatan', compact('equipments'));
    }

    public function editPeralatan(Equipment $equipment): View
    {
        return view('pages.admin-edit-peralatan', compact('equipment'));
    }

    public function updatePeralatan(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:0',
            'condition' => 'required|in:baik,rusak ringan,rusak berat',
            'purchase_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $equipment->update($request->only(['name', 'category', 'quantity', 'condition', 'purchase_date', 'description']));
        return redirect()->route('data-peralatan')->with('success', 'Data peralatan berhasil diperbarui.');
    }

    public function deletePeralatan(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('data-peralatan')->with('success', 'Data peralatan berhasil dihapus.');
    }

    // ========== Documentation / Asset Management ==========

    public function dataAssets(Request $request): View
    {
        $query = DocumentationMedia::query();

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('tags')) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            if (!empty($tagNames)) {
                $query->whereHas('tags', function ($q) use ($tagNames) {
                    $q->whereIn('name', $tagNames);
                });
            }
        }

        $assets = $query->orderByDesc('created_at')->paginate(12);
        return view('pages.admin-data-assets', compact('assets'));
    }

    public function dataEbooks(Request $request): View
    {
        $query = DocumentationMedia::where('type', 'ebook');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('tags')) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            if (!empty($tagNames)) {
                $query->whereHas('tags', function ($q) use ($tagNames) {
                    $q->whereIn('name', $tagNames);
                });
            }
        }

        $assets = $query->orderByDesc('created_at')->paginate(12);
        return view('pages.admin-data-ebook', compact('assets'));
    }

    public function dataCalendar(Request $request): View
    {
        $query = LessonSchedule::query();

        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('day', 'like', '%' . $request->q . '%')
                    ->orWhere('time', 'like', '%' . $request->q . '%')
                    ->orWhere('group', 'like', '%' . $request->q . '%')
                    ->orWhere('activity', 'like', '%' . $request->q . '%');
            });
        }

        $schedules = $query->orderBy('day')->orderBy('time')->get();
        return view('pages.admin-data-calendar', compact('schedules'));
    }

    public function createAsset(): View
    {
        return view('pages.admin-edit-asset');
    }

    public function storeAsset(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video,ebook',
            'file' => 'required|file|max:10240', // 10MB
        ]);

        if ($request->type === 'image' && ! str_starts_with($request->file('file')->getMimeType(), 'image/')) {
            return back()->withErrors(['file' => 'File harus berupa gambar untuk tipe Gambar.'])->withInput();
        }
        if ($request->type === 'video' && ! str_starts_with($request->file('file')->getMimeType(), 'video/')) {
            return back()->withErrors(['file' => 'File harus berupa video untuk tipe Video.'])->withInput();
        }
        if ($request->type === 'ebook' && ! in_array($request->file('file')->getClientOriginalExtension(), ['pdf', 'epub', 'doc', 'docx', 'txt'])) {
            return back()->withErrors(['file' => 'File ebook harus berekstensi PDF, EPUB, DOC, DOCX, atau TXT.'])->withInput();
        }

        $disk = $request->input('storage_disk', 'public');
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documentation', $disk);
        }

        $asset = DocumentationMedia::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_path' => $path,
            'storage_disk' => $disk,
        ]);

        // handle tags (comma-separated)
        if ($request->filled('tags')) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            $tagIds = [];
            foreach ($tagNames as $name) {
                $tag = \App\Models\Tag::firstOrCreate(['name' => $name], ['slug' => \Illuminate\Support\Str::slug($name)]);
                $tagIds[] = $tag->id;
            }
            $asset->tags()->sync($tagIds);
        }

        return redirect()->route('data-assets')->with('success', 'Aset berhasil diunggah.');
    }

    public function editAsset(DocumentationMedia $asset): View
    {
        return view('pages.admin-edit-asset', compact('asset'));
    }

    public function updateAsset(Request $request, DocumentationMedia $asset)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video,ebook',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($request->type === 'image' && ! str_starts_with($request->file('file')->getMimeType(), 'image/')) {
                return back()->withErrors(['file' => 'File harus berupa gambar untuk tipe Gambar.']);
            }
            if ($request->type === 'video' && ! str_starts_with($request->file('file')->getMimeType(), 'video/')) {
                return back()->withErrors(['file' => 'File harus berupa video untuk tipe Video.']);
            }
            if ($request->type === 'ebook' && ! in_array($request->file('file')->getClientOriginalExtension(), ['pdf', 'epub', 'doc', 'docx', 'txt'])) {
                return back()->withErrors(['file' => 'File ebook harus berekstensi PDF, EPUB, DOC, DOCX, atau TXT.']);
            }

            // save previous file as a version
            if (!empty($asset->file_path)) {
                \App\Models\DocumentationMediaVersion::create([
                    'documentation_media_id' => $asset->id,
                    'file_path' => $asset->file_path,
                    'storage_disk' => $asset->storage_disk ?? 'public',
                ]);
                Storage::disk($asset->storage_disk ?? 'public')->delete($asset->file_path);
            }
            $disk = $request->input('storage_disk', $asset->storage_disk ?? 'public');
            $asset->file_path = $request->file('file')->store('documentation', $disk);
            $asset->storage_disk = $disk;
        }

        $asset->title = $request->title;
        $asset->description = $request->description;
        $asset->type = $request->type;
        $asset->save();

        // tags
        if ($request->filled('tags')) {
            $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
            $tagIds = [];
            foreach ($tagNames as $name) {
                $tag = \App\Models\Tag::firstOrCreate(['name' => $name], ['slug' => \Illuminate\Support\Str::slug($name)]);
                $tagIds[] = $tag->id;
            }
            $asset->tags()->sync($tagIds);
        } else {
            $asset->tags()->sync([]);
        }

        return redirect()->route('data-assets')->with('success', 'Aset berhasil diperbarui.');
    }

    public function deleteAsset(DocumentationMedia $asset)
    {
        if (!empty($asset->file_path)) {
            Storage::disk($asset->storage_disk ?? 'public')->delete($asset->file_path);
        }
        $asset->delete();
        return redirect()->route('data-assets')->with('success', 'Aset berhasil dihapus.');
    }

    public function downloadAsset(DocumentationMedia $asset)
    {
        $disk = $asset->storage_disk ?? 'public';
        if (empty($asset->file_path) || !Storage::disk($disk)->exists($asset->file_path)) {
            return redirect()->route('data-assets')->with('success', 'File tidak ditemukan.');
        }

        $stream = Storage::disk($disk)->readStream($asset->file_path);
        $filename = pathinfo($asset->file_path, PATHINFO_BASENAME);
        return response()->streamDownload(function () use ($stream) {
            if (is_resource($stream)) {
                fpassthru($stream);
                fclose($stream);
            }
        }, $asset->title . '_' . $filename);
    }

    public function downloadAssetVersion(DocumentationMedia $asset, $versionId)
    {
        $version = \App\Models\DocumentationMediaVersion::where('documentation_media_id', $asset->id)->where('id', $versionId)->firstOrFail();
        $disk = $version->storage_disk ?? 'public';
        if (!Storage::disk($disk)->exists($version->file_path)) {
            return redirect()->route('data-assets')->with('success', 'File versi tidak ditemukan.');
        }
        $stream = Storage::disk($disk)->readStream($version->file_path);
        $filename = pathinfo($version->file_path, PATHINFO_BASENAME);
        return response()->streamDownload(function () use ($stream) {
            if (is_resource($stream)) {
                fpassthru($stream);
                fclose($stream);
            }
        }, $asset->title . '_v' . $version->id . '_' . $filename);
    }

    public function rollbackAssetVersion(Request $request, DocumentationMedia $asset, $versionId)
    {
        $version = \App\Models\DocumentationMediaVersion::where('documentation_media_id', $asset->id)->where('id', $versionId)->firstOrFail();
        if (!Storage::disk($version->storage_disk ?? 'public')->exists($version->file_path)) {
            return redirect()->route('data-assets')->with('success', 'File versi tidak ditemukan.');
        }

        // current file becomes a new version
        if (!empty($asset->file_path)) {
            \App\Models\DocumentationMediaVersion::create([
                'documentation_media_id' => $asset->id,
                'file_path' => $asset->file_path,
                'storage_disk' => $asset->storage_disk ?? 'public',
            ]);
            // delete current file from its disk
            Storage::disk($asset->storage_disk ?? 'public')->delete($asset->file_path);
        }

        // copy version file to the asset's disk if different (keep original path)
        $fromDisk = $version->storage_disk ?? 'public';
        $toDisk = $request->input('storage_disk', $asset->storage_disk ?? $fromDisk);

        // if disks are different, copy file between disks
        if ($fromDisk !== $toDisk) {
            $contents = Storage::disk($fromDisk)->get($version->file_path);
            $newFilename = time() . '_' . basename($version->file_path);
            $newPath = 'documentation/' . $newFilename;
            Storage::disk($toDisk)->put($newPath, $contents);
            $asset->file_path = $newPath;
            $asset->storage_disk = $toDisk;
        } else {
            $asset->file_path = $version->file_path;
            $asset->storage_disk = $fromDisk;
        }

        $asset->save();

        return redirect()->route('data-assets')->with('success', 'Aset berhasil di-rollback ke versi.' );
    }

    public function editTpqProfile(): View
    {
        $tpqSettings = TpqSetting::pluck('value','key')->all();
        return view('pages.admin-edit-tpq-profile', compact('tpqSettings'));
    }

    public function updateTpqProfile(Request $request)
    {
        $request->validate([
            'tpq_name' => 'required|string|max:255',
            'tpq_description' => 'nullable|string',
            'tpq_address' => 'nullable|string|max:500',
            'tpq_phone' => 'nullable|string|max:20',
            'tpq_email' => 'nullable|email',
            'tpq_hero_subtitle' => 'nullable|string|max:255',
            'tpq_features' => 'nullable|string',
            'tpq_vision' => 'nullable|string',
            'tpq_mission' => 'nullable|string',
            'tpq_programs' => 'nullable|string',
            'tpq_hours' => 'nullable|string|max:255',
            'tpq_years' => 'nullable|string|max:50',
            'tpq_highlights' => 'nullable|string',
            'tpq_team_members' => 'nullable|string',
            'logo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->only([
            'tpq_name',
            'tpq_description',
            'tpq_address',
            'tpq_phone',
            'tpq_email',
            'tpq_hero_subtitle',
            'tpq_features',
            'tpq_vision',
            'tpq_mission',
            'tpq_programs',
            'tpq_hours',
            'tpq_years',
            'tpq_highlights',
            'tpq_team_members',
        ]);

        foreach ($data as $k => $v) {
            TpqSetting::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if ($file->isValid()) {
                $path = $file->store('logos', 'public');
                TpqSetting::updateOrCreate(['key' => 'tpq_logo'], ['value' => $path]);
            }
        }

        // Clear any cached settings here if you implement caching

        return redirect()->route('admin')->with('success', 'Profil TPQ berhasil disimpan.');
    }

    public function editContactUs(): View
    {
        $messages = ContactMessage::orderByDesc('created_at')->limit(20)->get();
        return view('pages.admin-edit-contact', compact('messages'));
    }

    /**
     * Simple read-only API endpoint returning TPQ settings as JSON
     */
    public function apiTpqSettings()
    {
        $settings = TpqSetting::pluck('value', 'key')->all();
        return response()->json($settings);
    }

    public function removeTpqLogo(Request $request)
    {
        $setting = TpqSetting::where('key', 'tpq_logo')->first();
        if ($setting && !empty($setting->value)) {
            // delete file from public disk
            Storage::disk('public')->delete($setting->value);
            $setting->delete();
        }

        return redirect()->route('edit-tpq-profile')->with('success', 'Logo TPQ berhasil dihapus.');
    }

    public function deleteContactMessage(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('edit-contact-us')->with('success', 'Pesan kontak berhasil dihapus.');
    }
}

