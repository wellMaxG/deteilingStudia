<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
       

        // Валидация данных
        $validatedData = $request->validate([
        'client_name' => 'required|string',
        'phone' => 'nullable|string',
        'service_id' => 'required|exists:services,id',
        'appointment_datetime' => 'required|date',
        'question' => 'nullable|string',
        'user_id' => 'nullable|string',
    ]);
    if (!$user) {
        $validatedData['user_id'] = 999;
        } else {
        $validatedData['user_id'] = $user->id;
        }
        
        
    //     $appointment = new Appointment([
    //     // 'user_id' => $user->id,
    //     // 'user_id' => $user ? $user->id : null,
    //     // 'is_registered' => $isRegistered,
    // ]);
    
        Appointment::create($validatedData);


        return redirect()->route('home')->with('success', 'Вы успешно записались на услугу!');
    }

    public function show($id)
{
    // Найдем клиента по его ID
    $appointment = Appointment::findOrFail($id);
  
    return view('appointments.show', compact('appointment'));
}
   
    public function edit(Appointment $appointment)
    {
        $services = Service::all();
        return view('admin.appointments.edit', compact('appointment','services'));
    }
    
    public function update(Request $request, Appointment $appointment)
    {
        // Валидация данных, пример:
        $validatedData = $request->validate([
            'client_name' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'appointment_datetime' => 'required|date',
            'status' => 'required|string',
        ]);
        
        // Обновляем данные записи на услугу
        $appointment->update($validatedData);
        
        // Редирект на страницу со списком записей
        return redirect()->route('appointments.index');
    }
}
