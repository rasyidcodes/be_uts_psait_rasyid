<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perkuliahan;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class NilaiController extends Controller
{
    // Menampilkan semua nilai mahasiswa
     public function index()
    {


        $perkuliahan = Perkuliahan::with('mahasiswa', 'matakuliah')->get();


        if ($perkuliahan->isEmpty()) {
                return response()->json(['message' => 'Data not found'], 404);
         }


        $nilai = $perkuliahan->map(function ($item) {
            return [
                'id' => $item->id_perkuliahan,
                'attributes' => [
                    'nim' => $item->nim,
                    'nama' => $item->mahasiswa->nama,
                    'alamat' => $item->mahasiswa->alamat,
                    'tanggal_lahir' => $item->mahasiswa->tanggal_lahir,
                    'kode_mk' => $item->kode_mk,
                    'nama_mk' => $item->matakuliah->nama_mk,
                    'sks' => $item->matakuliah->sks,
                    'nilai' => $item->nilai,

                ]
            ];
        });

        return response()->json([
            'data' => $nilai,
            'meta' => [
                'count' => $nilai->count(),
                'message' => 'Data retrieved successfully.'
            ]
        ]);
    }

    // Menampilkan nilai mahasiswa tertentu berdasarkan NIM
    public function show($nim)
    {
        $nilai = Perkuliahan::where('nim', $nim)->get();

        if ($nilai->isEmpty()) {
            return response()->json([
                'error' => 'Data not found.',
            ], 404);
        }

        $formattedNilai = $nilai->map(function ($item) {
            return [
                'id' => $item->id_perkuliahan,
                'attributes' => [
                    'id_perkuliahan' => $item->id_perkuliahan,
                    'nim' => $item->nim,
                    'kode_mk' => $item->kode_mk,
                    'nilai' => $item->nilai,
                ]
            ];
        });

        return response()->json([
            'data' => $formattedNilai,
            'meta' => [
                'count' => $formattedNilai->count(),
                'message' => 'Data retrieved successfully.'
            ]
        ]);
    }


    // Memasukkan nilai baru untuk mahasiswa tertentu
    public function store(Request $request)
    {
        try {
        // Create a new Perkuliahan instance with the request data
        $nilai = Perkuliahan::create($request->all());

        // Prepare the response data
        $data = [
            'nilai' => $nilai,
        ];

        // Prepare the meta information
        $meta = [
            'status' => 'success',
            'message' => 'Perkuliahan data created successfully',
        ];

        // Return the response with data and meta
        return response()->json([
            'data' => $data,
            'meta' => $meta,
        ], 201);
    } catch (QueryException $e) {
        // If an exception occurred, handle it
        $errorMessage = 'Error occurred while creating Perkuliahan data: ' . $e->getMessage();

        // Prepare the meta information for error response
        $meta = [
            'status' => 'error',
            'message' => $errorMessage,
        ];

        // Return the error response with meta information and status code 400 (Bad Request)
        return response()->json([
            'meta' => $meta,
        ], 400);
    }
    }

    // Mengupdate nilai berdasarkan NIM dan kode_mk
    public function update(Request $request, $nim, $kode_mk)
    {
        try {
            // Find the Perkuliahan instance by nim and kode_mk
            $nilai = Perkuliahan::where('nim', $nim)->where('kode_mk', $kode_mk);

            // Check if the instance exists
            if (!$nilai) {
                // If the instance is not found, prepare the error response
                $errorMessage = 'Perkuliahan data with nim ' . $nim . ' and kode_mk ' . $kode_mk . ' not found.';

                // Return the error response with meta information and status code 404 (Not Found)
                return response()->json([
                    'meta' => [
                        'status' => 'error',
                        'message' => $errorMessage,
                    ]
                ], 404);
            }

            // Update the found Perkuliahan instance with the request data
            $nilai->update($request->all());

            // Prepare the response data
            $data = [
                'attributes' => $nilai,
            ];

            // Prepare the meta information
            $meta = [
                'status' => 'success',
                'message' => 'Perkuliahan data updated successfully',
            ];

            // Return the response with data and meta
            return response()->json([
                'data' => $data,
                'meta' => $meta,
            ], 200);

        } catch (QueryException $e) {
            // If an exception occurred during the update, handle it
            $errorMessage = 'Error occurred while updating Perkuliahan data: ' . $e->getMessage();

            // Return the error response with meta information and status code 400 (Bad Request)
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => $errorMessage,
                ]
            ], 400);
        }
    }


    // Menghapus nilai berdasarkan NIM dan kode_mk
    public function destroy($nim, $kode_mk)
{
    try {
        // Find the Perkuliahan instance by nim and kode_mk
        $nilai = Perkuliahan::where('nim', $nim)->where('kode_mk', $kode_mk)->firstOrFail();

        // Delete the found Perkuliahan instance
        $nilai->delete();

        $meta = [
            'status' => 'success',
            'message' => 'Perkuliahan data with nim ' . $nim . ' and kode_mk ' . $kode_mk . ' successfully deleted.',
        ];

        // Return a JSON response with status code 204 (No Content)
        return response()->json(null, 204);
    } catch (ModelNotFoundException $e) {
        // If Perkuliahan instance is not found, handle the exception
        $errorMessage = 'Perkuliahan data with nim ' . $nim . ' and kode_mk ' . $kode_mk . ' not found.';

        // Prepare the meta information for error response
        $meta = [
            'status' => 'error',
            'message' => $errorMessage,
        ];

        // Return the error response with meta information and status code 404 (Not Found)
        return response()->json([
            'meta' => $meta,
        ], 404);

    } catch (QueryException $e) {
        // If an exception occurred during the delete operation, handle it
        $errorMessage = 'Error occurred while deleting Perkuliahan data: ' . $e->getMessage();

        // Prepare the meta information for error response
        $meta = [
            'status' => 'error',
            'message' => $errorMessage,
        ];

        // Return the error response with meta information and status code 400 (Bad Request)
        return response()->json([
            'meta' => $meta,
        ], 400);
    }
    }
}
