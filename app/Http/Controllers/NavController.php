<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use App\Models\JabatanStruktural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;

class NavController extends Controller
{
    /**
     * Menampilkan daftar navigation.
     */
    public function index()
    {
        $data = Nav::with('jabatanStruktural')
            ->latest()
            ->get();

        return view('SuperAdmin.nav.index', [
            'title' => 'Navigation',
            'data' => $data,
        ]);
    }

    /**
     * Menampilkan form tambah navigation.
     */
    public function create()
    {
        $jabatanStrukturals = JabatanStruktural::orderBy('Nama_Jabatan')
            ->get();

        $controllers = $this->getControllers();

        $controllerMethods = $this->getControllerMethods();

        return view('SuperAdmin.nav.create', [
            'title' => 'Tambah Navigation',
            'jabatanStrukturals' => $jabatanStrukturals,
            'controllers' => $controllers,
            'controllerMethods' => $controllerMethods,
        ]);
    }

    /**
     * Menyimpan navigation baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan_struktural_id' => [
                'required',
                'exists:jabatan_strukturals,id',
            ],

            'Nama' => [
                'required',
                'string',
                'max:255',
            ],

            'Controller' => [
                'required',
                'string',
                'max:255',
            ],

            'Method' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        Nav::create($validated);

        return redirect()
            ->to(pageUrl('NavController'))
            ->with('success', 'Navigation berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail navigation.
     */
    public function show($id)
    {
        $data = Nav::with('jabatanStruktural')
            ->findOrFail($id);

        return view('SuperAdmin.nav.show', [
            'title' => 'Detail Navigation',
            'data' => $data,
        ]);
    }

    /**
     * Menampilkan form edit navigation.
     */
    public function edit($id)
    {
        $data = Nav::findOrFail($id);

        $jabatanStrukturals = JabatanStruktural::orderBy('Nama_Jabatan')
            ->get();

        $controllers = $this->getControllers();

        $controllerMethods = $this->getControllerMethods();

        return view('SuperAdmin.nav.edit', [
            'title' => 'Edit Navigation',
            'data' => $data,
            'jabatanStrukturals' => $jabatanStrukturals,
            'controllers' => $controllers,
            'controllerMethods' => $controllerMethods,
        ]);
    }

    /**
     * Memperbarui navigation.
     */
    public function update(Request $request, $id)
    {
        $data = Nav::findOrFail($id);

        $validated = $request->validate([
            'jabatan_struktural_id' => [
                'required',
                'exists:jabatan_strukturals,id',
            ],

            'Nama' => [
                'required',
                'string',
                'max:255',
            ],

            'Controller' => [
                'required',
                'string',
                'max:255',
            ],

            'Method' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('NavController'))
            ->with('success', 'Navigation berhasil diperbarui.');
    }

    /**
     * Menghapus navigation.
     */
    public function destroy($id)
    {
        $data = Nav::findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('NavController'))
            ->with('success', 'Navigation berhasil dihapus.');
    }

    /**
     * Mengambil semua Controller yang tersedia.
     */
    private function getControllers()
    {
        return collect(
            File::files(app_path('Http/Controllers'))
        )
            ->filter(function ($file) {
                return $file->getExtension() === 'php'
                    && $file->getFilename() !== 'Controller.php';
            })
            ->map(function ($file) {
                return pathinfo(
                    $file->getFilename(),
                    PATHINFO_FILENAME
                );
            })
            ->sort()
            ->values();
    }

    /**
     * Mengambil semua public method dari setiap Controller.
     */
    private function getControllerMethods()
    {
        $controllers = $this->getControllers();

        return $controllers->mapWithKeys(function ($controller) {

            $class = 'App\\Http\\Controllers\\' . $controller;

            if (!class_exists($class)) {
                return [
                    $controller => []
                ];
            }

            try {

                $reflection = new ReflectionClass($class);

                $methods = collect(
                    $reflection->getMethods(
                        ReflectionMethod::IS_PUBLIC
                    )
                )
                    ->filter(function ($method) use ($reflection) {

                        return $method->class === $reflection->getName()
                            && !str_starts_with(
                                $method->name,
                                '__'
                            );

                    })
                    ->map(function ($method) {
                        return $method->name;
                    })
                    ->sort()
                    ->values()
                    ->toArray();

                return [
                    $controller => $methods
                ];

            } catch (\Throwable $e) {

                return [
                    $controller => []
                ];

            }
        });
    }
}