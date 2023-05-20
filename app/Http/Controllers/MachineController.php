<?php

namespace App\Http\Controllers;

use App\Http\Resources\MachineResource;
use App\Models\Machine;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Request as FacadesRequest;

class MachineController extends Controller
{
    public function index(): Response
    {
        $this->authorize('viewAny', Machine::class);
        return Inertia::render(
            'Machines/Index',
            [
                'filters' => FacadesRequest::all('search'),
                'machines' => MachineResource::collection(
                    Machine::filter(FacadesRequest::only('search'))
                        ->paginate(10)
                        ->withQueryString()
                )
            ]
        );
    }
}
