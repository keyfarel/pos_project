<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\LevelModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Mengambil semua data level.');
        return LevelModel::all();
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validated = $request->validate([
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100',
            ]);

            $level = LevelModel::create($validated);

            Log::info('Level baru berhasil dibuat.', ['data' => $level]);

            return response()->json([
                'message' => 'Level berhasil dibuat.',
                'data' => $level
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validasi gagal',
                'details' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Gagal membuat level.', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan saat membuat level.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        try {
            $level = LevelModel::findOrFail($id);
            Log::info('Menampilkan data level.', ['id' => $id]);
            return response()->json($level);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Data level tidak ditemukan.'
            ], 404);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $level = LevelModel::findOrFail($id);

            $validated = $request->validate([
                'level_kode' => 'sometimes|required|string|max:10|unique:m_level,level_kode,' . $id,
                'level_nama' => 'sometimes|required|string|max:100',
            ]);

            $oldData = $level->toArray();
            $level->update($validated);

            Log::info('Data level diperbarui.', [
                'id' => $id,
                'sebelum' => $oldData,
                'sesudah' => $level
            ]);

            return response()->json($level);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Data level tidak ditemukan.'
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validasi gagal',
                'details' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Gagal memperbarui level.', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan saat memperbarui level.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $level = LevelModel::findOrFail($id);
            $level->delete();

            Log::warning("Level dengan ID {$id} dihapus.");

            return response()->json([
                'success' => true,
                'message' => 'Level berhasil dihapus.',
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Data level tidak ditemukan.'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Gagal menghapus level.', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan saat menghapus level.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
