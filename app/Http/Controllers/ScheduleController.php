<?php

namespace App\Http\Controllers;

use App\Models\UmmiLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EventSchedules;
use App\Models\QuoteSchedules;
use App\Models\WeeklySchedules;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Display main index page with all schedules
     */

    public function mainIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil jadwal mingguan beserta semua item detail-nya
        $weeklySchedules = WeeklySchedules::with(['items' => function ($query) {
            $query->orderBy('start_time', 'asc'); // urutkan berdasarkan waktu di tabel item
        }])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();

        $eventSchedules = EventSchedules::orderBy('event_date', 'desc')->get();
        $quoteSchedules = QuoteSchedules::latest()->get();
        $levels = UmmiLevel::all();

        return view('admin.schedules.index', compact('weeklySchedules', 'eventSchedules', 'quoteSchedules', 'levels'));
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default redirect to weekly schedule
        return redirect()->route('admin.weekly-schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default redirect to weekly schedule create
        return redirect()->route('admin.weekly-schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default store method - redirect back
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default show method - not implemented
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default edit method - redirect back
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default update method - redirect back
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Default destroy method - redirect back
        return back();
    }

    // ==================== WEEKLY SCHEDULE METHODS ====================

    /**
     * Display listing of weekly schedules
     */
    public function weeklyIndex()
    {
        if (!Auth::check()) return redirect()->route('login');

        $schedules = WeeklySchedules::with(['details.level'])
            ->orderByRaw("FIELD(day, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')")
            ->get();

        return view('admin.schedules.weekly-index', compact('schedules'));
    }

    public function weeklyCreate()
    {
        if (!Auth::check()) return redirect()->route('login');

        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $levels = UmmiLevel::all();

        return view('admin.schedules.weekly-create', compact('days', 'levels'));
    }

    /**
     * Store new weekly schedule
     */
    public function weeklyStore(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');

        // Validasi data
        $validated = $request->validate([
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'items' => 'required|array|min:1',
            'items.*.ummi_level_id' => 'required|exists:ummi_levels,id',
            'items.*.start_time' => 'required|date_format:H:i',
            'items.*.end_time' => 'required|date_format:H:i|after:items.*.start_time',
            'items.*.activity' => 'required|string|max:255',
            'items.*.teacher' => 'required|string|max:255',
        ]);

        try {
            // Cek apakah sudah ada jadwal untuk hari yang sama
            $existingSchedule = WeeklySchedules::where('day', $validated['day'])->first();

            if ($existingSchedule) {
                return redirect()->back()
                    ->with('error', 'Sudah ada jadwal untuk hari ' . $validated['day'])
                    ->withInput();
            }

            // Create the main schedule
            $schedule = WeeklySchedules::create([
                'day' => $validated['day']
            ]);

            // Create schedule items
            foreach ($validated['items'] as $item) {
                $schedule->items()->create([
                    'ummi_level_id' => $item['ummi_level_id'],
                    'start_time' => $item['start_time'],
                    'end_time' => $item['end_time'],
                    'activity' => $item['activity'],
                    'teacher' => $item['teacher']
                ]);
            }

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Jadwal mingguan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating weekly schedule: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan jadwal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function weeklyEdit($weeklyId)
    {
        if (!Auth::check()) return redirect()->route('login');

        $schedule = WeeklySchedules::with('items.ummiLevel')->findOrFail($weeklyId);

        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        $ummiLevels = UmmiLevel::all();

        return view('admin.schedules.weekly-edit', compact('schedule', 'days', 'ummiLevels'));
    }

    public function weeklyUpdate(Request $request, $weeklyId)
    {
        if (!Auth::check()) return redirect()->route('login');

        $validated = $request->validate([
            'day' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.ummi_level_id' => 'required|exists:ummi_levels,id',
            'items.*.teacher' => 'required|string|max:255',
            'items.*.activity' => 'required|string|max:255',
            'items.*.start_time' => 'required|date_format:H:i',
            'items.*.end_time' => 'required|date_format:H:i|after:items.*.start_time',
        ]);

        $schedule = WeeklySchedules::findOrFail($weeklyId);
        $schedule->update(['day' => $validated['day']]);

        // Hapus semua item lama
        $schedule->items()->delete();

        // Simpan ulang item baru
        foreach ($validated['items'] as $item) {
            $schedule->items()->create($item);
        }

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal mingguan berhasil diperbarui.');
    }

    public function weeklyDestroy($weeklyId)
    {
        if (!Auth::check()) return redirect()->route('login');

        $schedule = WeeklySchedules::findOrFail($weeklyId);
        $schedule->items()->delete();
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal mingguan berhasil dihapus.');
    }

    // ==================== EVENT SCHEDULE METHODS ====================

    /**
     * Display listing of event schedules
     */
    public function eventIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $events = EventSchedules::orderBy('event_date', 'desc')->get();
        return view('admin.schedules.event-index', compact('events'));
    }

    /**
     * Show form for creating event schedule
     */
    public function eventCreate()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.schedules.event-create');
    }

    /**
     * Store new event schedule
     */
    public function eventStore(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        try {
            $data = $validated;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
                $data['image'] = $imagePath;
            }

            EventSchedules::create($data);

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambah event: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show form for editing event schedule
     */
    public function eventEdit($eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $event = EventSchedules::findOrFail($eventId);
            return view('admin.schedules.event-edit', compact('event'));
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Event tidak ditemukan.');
        }
    }

    /**
     * Update event schedule
     */
    public function eventUpdate(Request $request, $eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        try {
            $event = EventSchedules::findOrFail($eventId);
            $data = $validated;

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }

                $imagePath = $request->file('image')->store('events', 'public');
                $data['image'] = $imagePath;
            } else {
                // Keep existing image if no new image uploaded
                $data['image'] = $event->image;
            }

            $event->update($data);

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui event: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete event schedule
     */
    public function eventDestroy($eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $event = EventSchedules::findOrFail($eventId);

            // Delete image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Terjadi kesalahan saat menghapus event: ' . $e->getMessage());
        }
    }

    /**
     * Show event details
     */
    public function eventShow($eventId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $event = EventSchedules::findOrFail($eventId);
            return view('admin.schedules.event-show', compact('event'));
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Event tidak ditemukan.');
        }
    }

    // ==================== QUOTE SCHEDULE METHODS ====================

    /**
     * Display listing of quote schedules
     */
    public function quoteIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $quotes = QuoteSchedules::latest()->get();
        return view('admin.schedules.quote-index', compact('quotes'));
    }

    /**
     * Show form for creating quote schedule
     */
    public function quoteCreate()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('admin.schedules.quote-create');
    }

    /**
     * Store new quote schedule
     */
    public function quoteStore(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'quote' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
        ]);

        try {
            QuoteSchedules::create($validated);

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Quote berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambah quote: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show form for editing quote schedule
     */
    public function quoteEdit($quoteId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $quote = QuoteSchedules::findOrFail($quoteId);
            return view('admin.schedules.quote-edit', compact('quote'));
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Quote tidak ditemukan.');
        }
    }

    /**
     * Update quote schedule
     */
    public function quoteUpdate(Request $request, $quoteId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $validated = $request->validate([
            'quote' => 'required|string|max:1000',
            'author' => 'required|string|max:255',
        ]);

        try {
            $quote = QuoteSchedules::findOrFail($quoteId);
            $quote->update($validated);

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Quote berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui quote: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete quote schedule
     */
    public function quoteDestroy($quoteId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $quote = QuoteSchedules::findOrFail($quoteId);
            $quote->delete();

            return redirect()->route('admin.schedules.index')
                ->with('success', 'Quote berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Terjadi kesalahan saat menghapus quote: ' . $e->getMessage());
        }
    }

    /**
     * Show quote details
     */
    public function quoteShow($quoteId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $quote = QuoteSchedules::findOrFail($quoteId);
            return view('admin.schedules.quote-show', compact('quote'));
        } catch (\Exception $e) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Quote tidak ditemukan.');
        }
    }

    // ==================== BULK ACTIONS ====================

    /**
     * Bulk delete for weekly schedules
     */
    public function weeklyBulkDestroy(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:weekly_schedules,id'
        ]);

        try {
            WeeklySchedules::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal yang dipilih berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus jadwal.'
            ], 500);
        }
    }

    /**
     * Bulk delete for event schedules
     */
    public function eventBulkDestroy(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:event_schedules,id'
        ]);

        try {
            $events = EventSchedules::whereIn('id', $request->ids)->get();

            foreach ($events as $event) {
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }
                $event->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Event yang dipilih berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus event.'
            ], 500);
        }
    }

    /**
     * Bulk delete for quote schedules
     */
    public function quoteBulkDestroy(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:quote_schedules,id'
        ]);

        try {
            QuoteSchedules::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Quote yang dipilih berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus quote.'
            ], 500);
        }
    }

    // ==================== SEARCH METHODS ====================

    /**
     * Search weekly schedules
     */
    public function weeklySearch(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $search = $request->get('search');

        $schedules = WeeklySchedules::when($search, function ($query) use ($search) {
            return $query->where('activity', 'like', "%{$search}%")
                ->orWhere('teacher', 'like', "%{$search}%")
                ->orWhere('day', 'like', "%{$search}%");
        })
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->orderBy('start_time')
            ->get();

        return view('admin.schedules.weekly-index', compact('schedules'));
    }

    /**
     * Search event schedules
     */
    public function eventSearch(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $search = $request->get('search');

        $events = EventSchedules::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->orderBy('event_date', 'desc')
            ->get();

        return view('admin.schedules.event-index', compact('events'));
    }

    /**
     * Search quote schedules
     */
    public function quoteSearch(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $search = $request->get('search');

        $quotes = QuoteSchedules::when($search, function ($query) use ($search) {
            return $query->where('quote', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        })
            ->latest()
            ->get();

        return view('admin.schedules.quote-index', compact('quotes'));
    }
}
