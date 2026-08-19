<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentMeeting;
use App\Models\AssignmentGroup;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    /**
     * Daftar seluruh tugas.
     */
    public function index(Request $request): View
    {
        $kelas = trim(
            (string) $request->get('kelas', '')
        );

        $pertemuan = $request->get('pertemuan');

        $mode = trim(
            (string) $request->get(
                'mode_pengumpulan',
                ''
            )
        );

        $status = trim(
            (string) $request->get(
                'status',
                ''
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Daftar kelas aktif
        |--------------------------------------------------------------------------
        */

        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Daftar tugas
        |--------------------------------------------------------------------------
        */

        $query = Assignment::query()
            ->with([
                'assignmentMeeting',
            ])
            ->withCount([
                'groups',
                'submissions',
            ])
            ->orderByDesc('pertemuan')
            ->orderByDesc('id');


        /*
        |--------------------------------------------------------------------------
        | Filter kelas
        |--------------------------------------------------------------------------
        */

        if ($kelas !== '') {

            $query->where(
                'kelas',
                $kelas
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter pertemuan
        |--------------------------------------------------------------------------
        */

        if (
            $pertemuan !== null &&
            $pertemuan !== '' &&
            is_numeric($pertemuan)
        ) {

            $query->where(
                'pertemuan',
                (int) $pertemuan
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter mode
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $mode,
                [
                    'individu',
                    'kelompok',
                ],
                true
            )
        ) {

            $query->where(
                'mode_pengumpulan',
                $mode
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Filter status
        |--------------------------------------------------------------------------
        */

        if ($status === 'aktif') {

            $query->where(
                'aktif',
                true
            );

        } elseif ($status === 'nonaktif') {

            $query->where(
                'aktif',
                false
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $assignments = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Daftar Pertemuan
        |--------------------------------------------------------------------------
        |
        | Pertemuan sekarang berdiri sendiri dan dibuat manual
        | oleh guru melalui AssignmentMeeting.
        |
        */

        $meetingQuery = AssignmentMeeting::query()
            ->orderBy('kelas')
            ->orderBy('pertemuan');


        if ($kelas !== '') {

            $meetingQuery->where(
                'kelas',
                $kelas
            );
        }


        $meetingNumbers = $meetingQuery
            ->get()
            ->unique('pertemuan')
            ->pluck('pertemuan')
            ->sort()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Semua pertemuan berdasarkan kelas
        |--------------------------------------------------------------------------
        */

        $assignmentMeetings = AssignmentMeeting::query()
            ->where('aktif', true)
            ->orderBy('kelas')
            ->orderBy('pertemuan')
            ->get();


        return view(
            'guru.assignments.index',
            compact(
                'assignments',
                'classes',
                'meetingNumbers',
                'assignmentMeetings',
                'kelas',
                'pertemuan',
                'mode',
                'status'
            )
        );
    }


    /**
     * Form tambah tugas.
     *
     * Pertemuan tidak lagi dibuat otomatis.
     */
    public function create(Request $request): View
    {
        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Kelas yang dipilih
        |--------------------------------------------------------------------------
        */

        $kelas = trim(
            (string) $request->get(
                'kelas',
                ''
            )
        );


        /*
        |--------------------------------------------------------------------------
        | Daftar pertemuan yang sudah dibuat
        |--------------------------------------------------------------------------
        */

        $meetingQuery = AssignmentMeeting::query()
            ->where('aktif', true)
            ->orderBy('pertemuan');


        if ($kelas !== '') {

            $meetingQuery->where(
                'kelas',
                $kelas
            );
        }


        $assignmentMeetings = $meetingQuery
            ->get();


        return view(
            'guru.assignments.create',
            compact(
                'classes',
                'assignmentMeetings',
                'kelas'
            )
        );
    }


    /**
     * Simpan tugas baru.
     */
    public function store(
        Request $request
    ): RedirectResponse {

        $validated = $request->validate([

            'assignment_meeting_id' => [
                'required',
                'integer',
                'exists:assignment_meetings,id',
            ],

            'kelas' => [
                'required',
                'string',
                'max:50',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'instruksi' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'mode_pengumpulan' => [
                'required',
                'in:individu,kelompok',
            ],

            'batas_waktu' => [
                'nullable',
                'date',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ], [

            'assignment_meeting_id.required' =>
                'Pertemuan wajib dipilih.',

            'assignment_meeting_id.exists' =>
                'Pertemuan tidak ditemukan.',

            'kelas.required' =>
                'Kelas wajib dipilih.',

            'judul.required' =>
                'Judul tugas wajib diisi.',

            'mode_pengumpulan.required' =>
                'Jenis pengumpulan wajib dipilih.',

            'mode_pengumpulan.in' =>
                'Jenis pengumpulan tidak valid.',

            'batas_waktu.date' =>
                'Tenggang waktu tidak valid.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil Pertemuan
        |--------------------------------------------------------------------------
        */

        $meeting = AssignmentMeeting::query()
            ->whereKey(
                $validated['assignment_meeting_id']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (!$meeting) {

            return back()
                ->withInput()
                ->withErrors([
                    'assignment_meeting_id' =>
                        'Pertemuan tidak tersedia atau sudah dinonaktifkan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pertemuan harus berasal dari kelas yang dipilih
        |--------------------------------------------------------------------------
        */

        if (
            trim(
                (string) $meeting->kelas
            ) !==
            trim(
                (string) $validated['kelas']
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'assignment_meeting_id' =>
                        'Pertemuan yang dipilih bukan milik kelas tersebut.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas aktif
        |--------------------------------------------------------------------------
        */

        $classExists = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->exists();


        if (!$classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Deadline
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['batas_waktu']
            ) &&
            now()->greaterThan(
                $validated['batas_waktu']
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'batas_waktu' =>
                        'Tenggang waktu harus berada di masa depan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan tugas
        |--------------------------------------------------------------------------
        */

        $assignment = Assignment::create([

            'assignment_meeting_id' =>
                $meeting->id,

            'kelas' =>
                $meeting->kelas,

            'pertemuan' =>
                (int) $meeting->pertemuan,

            'judul' =>
                $validated['judul'],

            'instruksi' =>
                $validated['instruksi'] ?? null,

            'mode_pengumpulan' =>
                $validated['mode_pengumpulan'],

            'batas_waktu' =>
                $validated['batas_waktu'] ?? null,

            'aktif' =>
                $request->boolean(
                    'aktif',
                    true
                ),
        ]);


        return redirect()
            ->route(
                'guru.assignments.show',
                $assignment
            )
            ->with(
                'success',
                'Tugas berhasil dibuat.'
            );
    }


    /**
     * Detail tugas.
     */
    public function show(
        Assignment $assignment
    ): View {

        $assignment->load([
            'assignmentMeeting',
            'groups.members.student',
            'submissions.student',
            'submissions.group.members.student',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Daftar siswa aktif dari kelas tugas
        |--------------------------------------------------------------------------
        */

        $students = Student::query()
            ->where(
                'kelas',
                $assignment->kelas
            )
            ->where(
                'aktif',
                true
            )
            ->orderBy('nomor_absen')
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Siswa yang sudah masuk kelompok
        |--------------------------------------------------------------------------
        */

        $usedStudentIds = $assignment
            ->groups()
            ->with('members')
            ->get()
            ->flatMap(
                fn ($group) =>
                    $group->members
                        ->pluck('student_id')
            )
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Siswa yang belum masuk kelompok
        |--------------------------------------------------------------------------
        */

        $availableStudents = $students
            ->whereNotIn(
                'id',
                $usedStudentIds
            )
            ->values();


        return view(
            'guru.assignments.show',
            compact(
                'assignment',
                'students',
                'availableStudents'
            )
        );
    }


    /**
     * Form edit tugas.
     */
    public function edit(
        Assignment $assignment
    ): View {

        $assignment->load([
            'assignmentMeeting',
        ]);


        $classes = ClassRoom::query()
            ->where('aktif', true)
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Pertemuan berdasarkan kelas tugas
        |--------------------------------------------------------------------------
        */

        $assignmentMeetings = AssignmentMeeting::query()
            ->where(
                'kelas',
                $assignment->kelas
            )
            ->where(
                'aktif',
                true
            )
            ->orderBy('pertemuan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Pastikan pertemuan tugas saat ini tetap tersedia
        |--------------------------------------------------------------------------
        */

        if (
            $assignment->assignmentMeeting &&
            !$assignmentMeetings->contains(
                'id',
                $assignment->assignmentMeeting->id
            )
        ) {

            $assignmentMeetings->push(
                $assignment->assignmentMeeting
            );

            $assignmentMeetings =
                $assignmentMeetings
                    ->sortBy('pertemuan')
                    ->values();
        }


        return view(
            'guru.assignments.edit',
            compact(
                'assignment',
                'classes',
                'assignmentMeetings'
            )
        );
    }


    /**
     * Update tugas.
     */
    public function update(
        Request $request,
        Assignment $assignment
    ): RedirectResponse {

        $validated = $request->validate([

            'assignment_meeting_id' => [
                'required',
                'integer',
                'exists:assignment_meetings,id',
            ],

            'kelas' => [
                'required',
                'string',
                'max:50',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'instruksi' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'mode_pengumpulan' => [
                'required',
                'in:individu,kelompok',
            ],

            'batas_waktu' => [
                'nullable',
                'date',
            ],

            'aktif' => [
                'nullable',
                'boolean',
            ],

        ], [

            'assignment_meeting_id.required' =>
                'Pertemuan wajib dipilih.',

            'assignment_meeting_id.exists' =>
                'Pertemuan tidak ditemukan.',

            'kelas.required' =>
                'Kelas wajib dipilih.',

            'judul.required' =>
                'Judul tugas wajib diisi.',

            'mode_pengumpulan.required' =>
                'Jenis pengumpulan wajib dipilih.',

            'mode_pengumpulan.in' =>
                'Jenis pengumpulan tidak valid.',

            'batas_waktu.date' =>
                'Tenggang waktu tidak valid.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil Pertemuan
        |--------------------------------------------------------------------------
        */

        $meeting = AssignmentMeeting::query()
            ->whereKey(
                $validated['assignment_meeting_id']
            )
            ->where(
                'aktif',
                true
            )
            ->first();


        if (!$meeting) {

            return back()
                ->withInput()
                ->withErrors([
                    'assignment_meeting_id' =>
                        'Pertemuan tidak tersedia atau sudah dinonaktifkan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pertemuan harus sesuai kelas
        |--------------------------------------------------------------------------
        */

        if (
            trim(
                (string) $meeting->kelas
            ) !==
            trim(
                (string) $validated['kelas']
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'assignment_meeting_id' =>
                        'Pertemuan yang dipilih bukan milik kelas tersebut.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas tersedia
        |--------------------------------------------------------------------------
        */

        $classExists = ClassRoom::query()
            ->where(
                'nama',
                $validated['kelas']
            )
            ->where(
                'aktif',
                true
            )
            ->exists();


        if (!$classExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'kelas' =>
                        'Kelas yang dipilih tidak tersedia.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Deadline
        |--------------------------------------------------------------------------
        */

        if (
            !empty(
                $validated['batas_waktu']
            ) &&
            now()->greaterThan(
                $validated['batas_waktu']
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'batas_waktu' =>
                        'Tenggang waktu harus berada di masa depan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan mengubah mode tugas jika sudah memiliki
        | kelompok atau pengumpulan.
        |--------------------------------------------------------------------------
        */

        $hasGroups =
            $assignment
                ->groups()
                ->exists();


        $hasSubmissions =
            $assignment
                ->submissions()
                ->exists();


        if (
            $assignment->mode_pengumpulan !==
            $validated['mode_pengumpulan']
        ) {

            if (
                $hasGroups ||
                $hasSubmissions
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'mode_pengumpulan' =>
                            'Jenis pengumpulan tidak dapat diubah karena tugas sudah memiliki kelompok atau pengumpulan.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan memindahkan tugas kelompok yang sudah memiliki
        | kelompok atau pengumpulan ke kelas/pertemuan lain.
        |--------------------------------------------------------------------------
        */

        $meetingChanged =
            (int) $assignment->assignment_meeting_id !==
            (int) $meeting->id;


        if (
            $meetingChanged &&
            (
                $hasGroups ||
                $hasSubmissions
            )
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'assignment_meeting_id' =>
                        'Pertemuan tugas tidak dapat diubah karena tugas sudah memiliki kelompok atau pengumpulan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $assignment->update([

            'assignment_meeting_id' =>
                $meeting->id,

            'kelas' =>
                $meeting->kelas,

            'pertemuan' =>
                (int) $meeting->pertemuan,

            'judul' =>
                $validated['judul'],

            'instruksi' =>
                $validated['instruksi'] ?? null,

            'mode_pengumpulan' =>
                $validated['mode_pengumpulan'],

            'batas_waktu' =>
                $validated['batas_waktu'] ?? null,

            'aktif' =>
                $request->boolean(
                    'aktif',
                    false
                ),
        ]);


        return redirect()
            ->route(
                'guru.assignments.show',
                $assignment
            )
            ->with(
                'success',
                'Tugas berhasil diperbarui.'
            );
    }


    /**
     * Hapus tugas.
     */
    public function destroy(
        Assignment $assignment
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Hapus dalam transaksi
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $assignment
            ) {

                /*
                |--------------------------------------------------------------------------
                | Kelompok
                |--------------------------------------------------------------------------
                */

                $assignment
                    ->groups()
                    ->delete();


                /*
                |--------------------------------------------------------------------------
                | Submission
                |--------------------------------------------------------------------------
                */

                $assignment
                    ->submissions()
                    ->delete();


                /*
                |--------------------------------------------------------------------------
                | Tugas
                |--------------------------------------------------------------------------
                */

                $assignment->delete();
            }
        );


        return redirect()
            ->route(
                'guru.assignments.index'
            )
            ->with(
                'success',
                'Tugas berhasil dihapus.'
            );
    }


    /**
     * Aktifkan / nonaktifkan tugas.
     */
    public function toggle(
        Assignment $assignment
    ): RedirectResponse {

        $assignment->update([
            'aktif' =>
                !$assignment->aktif,
        ]);


        $status = $assignment->aktif
            ? 'diaktifkan'
            : 'dinonaktifkan';


        return back()
            ->with(
                'success',
                "Tugas berhasil {$status}."
            );
    }


    /**
     * Pencarian siswa berdasarkan kelas tugas.
     *
     * Siswa yang sudah berada dalam kelompok
     * tidak ditampilkan.
     */
    public function searchStudents(
        Request $request,
        Assignment $assignment
    ): JsonResponse {

        $search = trim(
            (string) $request->get(
                'q',
                ''
            )
        );


        if (
            mb_strlen($search) < 1
        ) {

            return response()->json([
                'data' => [],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil ID siswa yang sudah masuk kelompok
        |--------------------------------------------------------------------------
        */

        $usedStudentIds = $assignment
            ->groups()
            ->with('members')
            ->get()
            ->flatMap(
                fn ($group) =>
                    $group->members
                        ->pluck('student_id')
            )
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Cari siswa dari kelas tugas
        |--------------------------------------------------------------------------
        */

        $students = Student::query()
            ->where(
                'kelas',
                $assignment->kelas
            )
            ->where(
                'aktif',
                true
            )
            ->when(
                $usedStudentIds->isNotEmpty(),
                function ($query) use (
                    $usedStudentIds
                ) {

                    $query->whereNotIn(
                        'id',
                        $usedStudentIds
                    );
                }
            )
            ->where(
                function ($query) use (
                    $search
                ) {

                    $query
                        ->where(
                            'nama',
                            'like',
                            '%' .
                            $search .
                            '%'
                        )
                        ->orWhere(
                            'nomor_absen',
                            'like',
                            '%' .
                            $search .
                            '%'
                        );
                }
            )
            ->orderBy('nomor_absen')
            ->orderBy('nama')
            ->limit(20)
            ->get([
                'id',
                'nama',
                'kelas',
                'nomor_absen',
            ]);


        return response()->json([
            'data' =>
                $students,
        ]);
    }
}