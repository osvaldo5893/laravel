<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usuario' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
        ]);

        $usuario = Usuario::create([
            'usuario' => $validatedData['usuario'],
            'rol' => $validatedData['rol'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json($usuario, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validatedData = $request->validate([
            'usuario' => 'sometimes|string|max:255',
            'rol' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
        ]);

        $usuario = Usuario::findOrFail($id);
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $usuario->update($validatedData);

        return response()->json($usuario);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito']);

    }

    public function verificarUsuarioYContrasena(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar el usuario en la base de datos por el nombre de usuario
        $usuario = Usuario::where('usuario', $request->usuario)->first();

        // Verificar si el usuario existe
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Verificar la contraseña (aquí asumimos que la contraseña está almacenada de forma segura, como un hash)
        if ($usuario->password !== $request->password) {
            return response()->json(['message' => 'Contraseña incorrecta'], 401);
        }

        // Si el usuario y la contraseña son correctos, devolver los valores del usuario
        return response()->json([
            'message' => 'Usuario verificado con éxito',
            'usuario' => $usuario
        ]);
    }

    public function cargarArchivoExcel(Request $request)
    {
        // dd($request->all()); // Esto mostrará todo el contenido enviado

        // Validar que se subió un archivo
        $request->validate([
            'archivo' => 'required|file',
        ]);
    
        // Guardar temporalmente el archivo en el servidor
        // $originalName = $request->file('archivo')->getClientOriginalName();
        // // $rutaArchivo = $request->file('archivo')->storeAs('temp', $originalName);
        // $rutaArchivo = $request->file('archivo')->move(env('PUBLIC_UPLOADS_PATH'), $originalName);
        
        // // Obtener la ruta completa del archivo
        // $rutaCompleta = storage_path('app/' . $rutaArchivo);
        // // dd($rutaCompleta);
    
        try {
            // Cargar el archivo en la tabla temporal
            // DB::connection()->getPdo()->exec("
            //     LOAD DATA LOCAL INFILE 'C:\xampp\htdocs\uploads\Prueba.csv'
            //     INTO TABLE tabla_temporal
            //     FIELDS TERMINATED BY ',' 
            //     ENCLOSED BY '\"'
            //     LINES TERMINATED BY '\n'
            //     IGNORE 1 ROWS;
            // ");
            DB::statement('CALL nombre_del_procedimiento();');
            
            return response()->json(['message' => 'Carga masiva completada con éxito','path'=>$rutaCompleta], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar el archivo: ' . $e->getMessage()], 500);
        } finally {
            // Eliminar el archivo temporal
            if (file_exists($rutaCompleta)) {
                unlink($rutaCompleta);
            }
        }
    }
    



}
