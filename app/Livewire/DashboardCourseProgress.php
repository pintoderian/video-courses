<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserVideoProgress;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardCourseProgress extends Component
{
    public $users;
    public $userProgress = [];
    public $courses;
    public $isAdmin;

    public function mount()
    {
        $this->isAdmin = Auth::user()->hasRole('admin');
        $this->users = User::all();  // Listar todos los usuarios

        if ($this->isAdmin) {
            $this->courses = Course::all();
            $this->loadAllUserProgress();
        } else {
            $this->courses = Auth::user()->courses;
            $this->loadUserProgress(Auth::id());
        }
    }

    // Obtener el progreso de todos los usuarios
    private function loadAllUserProgress()
    {
        foreach ($this->users as $user) {
            $this->userProgress[$user->id] = [];

            foreach ($this->courses as $course) {
                $userProgressData = UserVideoProgress::where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->first();

                if ($userProgressData) {
                    $this->userProgress[$user->id][$course->id] = [
                        'current_video' => $this->getCurrentVideo($user->id, $course->id),
                        'percentage' => $this->calculateCourseProgress($course->id, $user->id),
                        'progress' => $userProgressData->is_completed ? 'Completed' : 'In Progress',
                    ];
                } else {
                    $this->userProgress[$user->id][$course->id] = [
                        'current_video' => 'N/A',
                        'percentage' => 0,
                        'progress' => 'Not Started',
                    ];
                }
            }
        }
    }

    private function loadUserProgress($userId)
    {
        foreach ($this->courses as $course) {
            $this->userProgress[$course->id] = [];

            // Cargar progreso del usuario actual para este curso
            $userProgress = UserVideoProgress::where('user_id', $userId)
                ->where('course_id', $course->id)
                ->get()
                ->map(function ($progress) {
                    return [
                        'progress' => $progress->is_completed ? 'Completed' : 'In Progress',
                    ];
                })
                ->first();

            $this->userProgress[$course->id][] = $userProgress;
            // Aseguramos que siempre haya un porcentaje para el curso
            $this->userProgress[$course->id]['percentage'] = $this->calculateCourseProgress($course->id, $userId);
        }
    }
    // Obtener el video actual de un usuario
    private function getCurrentVideo($userId, $courseId)
    {
        $currentVideo = UserVideoProgress::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('is_completed', false)
            ->first();

        return $currentVideo ? $currentVideo->video->name : 'N/A';
    }

    // Calcular el progreso de un curso para un usuario
    private function calculateCourseProgress($courseId, $userId)
    {
        $totalVideos = Video::where('course_id', $courseId)->count();
        $completedVideos = UserVideoProgress::where('course_id', $courseId)
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->count();

        return $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;
    }

    public function render()
    {
        return view('livewire.dashboard-course-progress');
    }
}
