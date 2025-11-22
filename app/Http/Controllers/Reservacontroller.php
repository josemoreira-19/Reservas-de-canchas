<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Muestra todas las reservas en una lista (tabla, cards, etc.)
     * GET /reservas
     */
    public function index()
    {
        // Cargamos todas las reservas, incluyendo datos del usuario y cancha
        // with() evita consultas repetidas (carga relaciones)
        // $reservas = Reserva::with(['user', 'cancha'])->get();

        // Retornamos la vista /resources/views/reservas/index.blade.php
        // y le enviamos las reservas para mostrarlas
        // return view('reservas.index', compact('reservas'));
        return $reservas = Reserva::with(['user', 'cancha'])->get();
    }

    /**
     * Muestra el formulario para crear una nueva reserva.
     * GET /reservas/create
     */
    public function create()
    {
        // Normalmente aquí enviamos listas de usuarios o canchas
        // pero por ahora lo dejamos simple
        return view('reservas.create');
    }

    /**
     * Guarda una nueva reserva en la base de datos.
     * POST /reservas
     */
    public function store(Request $request)
    {
        // Validación de los datos que llegan del formulario
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',     // debe existir en users
            'cancha_id'  => 'required|exists:canchas,id',   // debe existir en canchas
            'fecha'      => 'required|date',
            'hora_inicio'=> 'required',
            'hora_fin'   => 'required',
            'estado'     => 'nullable'  // opcional, si no viene usa "pendiente"
        ]);

        // Crea una nueva reserva usando los datos validados
        Reserva::create($data);

        // Redirige a la lista de reservas con un mensaje de éxito
        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva creada correctamente.');
    }

    /**
     * Muestra una reserva en detalle.
     * GET /reservas/{reserva}
     * Laravel automáticamente inyecta la reserva con Route Model Binding.
     */
    public function show(Reserva $reserva)
    {
        // Enviamos la reserva a la vista de detalle
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Muestra un formulario para editar una reserva.
     * GET /reservas/{reserva}/edit
     */
    public function edit(Reserva $reserva)
    {
        // Enviamos la reserva ya existente para rellenar el formulario
        return view('reservas.edit', compact('reserva'));
    }

    /**
     * Actualiza los datos de una reserva existente.
     * PUT /reservas/{reserva}
     */
    public function update(Request $request, Reserva $reserva)
    {
        // Validamos la información que llega del formulario de edición
        $data = $request->validate([
            'fecha'      => 'required|date',
            'hora_inicio'=> 'required',
            'hora_fin'   => 'required',
            'estado'     => 'required'
        ]);

        // Actualiza la reserva con los nuevos datos
        $reserva->update($data);

        // Redirige de vuelta al index con un mensaje
        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva actualizada correctamente.');
    }

    /**
     * Elimina una reserva.
     * DELETE /reservas/{reserva}
     */
    public function destroy(Reserva $reserva)
    {
        // Borra la reserva de la base de datos
        $reserva->delete();

        // Redirige de vuelta al index con mensaje
        return redirect()->route('reservas.index')
                         ->with('success', 'Reserva eliminada correctamente.');
    }
}
