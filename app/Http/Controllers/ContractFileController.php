<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContractFileController extends Controller
{
    /**
     * Store a newly uploaded file for a contract.
     */
    public function store(Request $request, Contract $contract)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
            'file_type' => 'required|string|in:termo_referencia,aditivo,contrato,outros',
        ]);

        $file = $request->file('file');
        $path = $file->store('contract_files/' . $contract->id, 'local');

        $contractFile = $contract->files()->create([
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $request->file_type,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ]);

        return back()->with('success', 'Arquivo enviado com sucesso!');
    }

    /**
     * Download a contract file.
     */
    public function download(ContractFile $file): StreamedResponse
    {
        if (!Storage::disk('local')->exists($file->file_path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::disk('local')->download($file->file_path, $file->original_name);
    }

    /**
     * Preview/view a contract file inline in browser.
     */
    public function preview(ContractFile $file): StreamedResponse
    {
        if (!Storage::disk('local')->exists($file->file_path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return new StreamedResponse(function () use ($file) {
            $stream = Storage::disk('local')->readStream($file->file_path);
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
        ]);
    }

    /**
     * Delete a contract file.
     */
    public function destroy(ContractFile $file)
    {
        // Delete file from storage
        if (Storage::disk('local')->exists($file->file_path)) {
            Storage::disk('local')->delete($file->file_path);
        }

        // Delete database record
        $file->delete();

        return back()->with('success', 'Arquivo excluído com sucesso!');
    }
}
