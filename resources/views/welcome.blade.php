<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>API REST</title>
        <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    </head>
    <body style="margin: 0%; height: auto;">
        <div style="width: 80%; margin: auto; height: auto; margin-bottom: 10px;">
        <h1 style="text-align: center; font-family: Arial, Helvetica, sans-serif; color:orangered; font-weight: 800">API REST LARAVEL - CITYTOURS</h1>
        <h3 style="text-align: center; font-family: Arial, Helvetica, sans-serif;">Documentacion</h3>
        <h3 style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: gray;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo dolorem assumenda mollitia at rerum earum reiciendis, voluptatibus repellendus dignissimos nihil dolore ratione ab quas, adipisci quam, animi non aspernatur eum.</h3>
        <h4 style="font-family: Arial, Helvetica, sans-serif;">Obtener Todos Los Servicios</h4>
        <div class="descripcion" style=" height: 7vh; display: flex; align-items: center; margin: auto; box-shadow: 0 0 2px 0; border-radius: 10px; display: flex; justify-content: space-between;">
           <span style="font-family: Arial, Helvetica, sans-serif; color: blueviolet; font-weight: 600; font-size: 15px; width: 95%; text-align: center;">
            Route::get('/',function(){

                $url = env("URL_SERVER_API",'http://127.0.0.1');
                $response = Http::get($url. '/Servicios');
                $destinos = $response->json();
                return view('Inicio',compact('destinos')); 
            });
           </span>
           <i class="fa-solid fa-check" style="width: 5%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 25px; cursor: pointer; display: none;" id="check"></i>
           <i class="fa-regular fa-copy" style="width: 5%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 25px; cursor: pointer;" id="copy" onclick="copy()"></i>
        </div>
        <h4 style="font-family: Arial, Helvetica, sans-serif;">Ejemplo</h1>
        <div style="width: 100%; display: flex; align-items: center;">
            @foreach ($data as $datos)
            <div class="lugar">
                <style>
                    .lugar{
                        width: 200px; height: 5vh; margin: 10px; display: flex; justify-content: center; background: orangered; align-items: center; 5px; border-radius: 10px; color: white; font-weight: 500; font-family: Arial;
                    }
                    .lugar:hover {
                        background: blue;
                        color: white;
                    }
                </style>
                {{$datos['nombre']}}
            </div>
            @endforeach
        </div>
        <h4 style="font-family: Arial, Helvetica, sans-serif;">Insertar Nuevo Servicios</h4>
        <div class="descripcion" style=" height: 15vh; display: flex; align-items: center; margin: auto; box-shadow: 0 0 2px 0; border-radius: 10px; display: flex; justify-content: space-between;">
           <span style="font-family: Arial, Helvetica, sans-serif; color: blueviolet; font-weight: 600; font-size: 15px; width: 89%; line-height: 25px; margin: auto; text-align: start;">
            public function store(Request $request){

                $this->validate($request,[
                    'nombre' => 'required',
                    'ubicacion' => 'required',
                    'clima' => 'required',
                    'descripcion' => 'required',
                    'horario' => 'required',
                    'imagen' => 'required',
                    'costo' => 'required',
                    'descuento' => 'required'
                ]);
                $url = env("URL_SERVER_API", 'http://127.0.0.1');
                $response = Http::post($url . '/ServicioAdd', [
                    'nombre' => $request->nombre,
                    'ubicacion' => $request->ubicacion,
                    'clima' => $request->clima,
                    'descripcion' => $request->descripcion,
                    'horario' => $request->horario,
                    'imagen' => $request->imagen,
                    'costo' => $request->costo,
                    'descuento' => $request->descuento
                ]);
        
                $suc = $response->json();
                dd($suc);
            }
           </span>
           <i class="fa-regular fa-copy" style="width: 5%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 25px; cursor: pointer;"></i>
        </div>
        <h4 style="font-family: Arial, Helvetica, sans-serif;">Eliminar Servicio</h4>
        <div class="descripcion" style=" height: 10vh; display: flex; align-items: center; margin: auto; box-shadow: 0 0 2px 0; border-radius: 10px; display: flex; justify-content: space-between;">
           <span style="font-family: Arial, Helvetica, sans-serif; color: blueviolet; font-weight: 600; font-size: 15px; width: 89%; line-height: 25px; margin: auto; text-align: start;">
            public function delete($id){
                $url = env("URL_SERVER_API",'http://127.0.0.1');
                $response = Http::delete($url.'/Servicios/'.$id);
                $us = $response->json();
                return back()->with('success', $us['message']); 
            }
           </span>
           <i class="fa-regular fa-copy" style="width: 5%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 25px; cursor: pointer;"></i>
        </div>
        <h4 style="font-family: Arial, Helvetica, sans-serif;">Editar Servicio</h4>
        <div class="descripcion" style=" height: 10vh; display: flex; align-items: center; margin: auto; box-shadow: 0 0 2px 0; border-radius: 10px; display: flex; justify-content: space-between;">
           <span style="font-family: Arial, Helvetica, sans-serif; color: blueviolet; font-weight: 600; font-size: 15px; width: 89%; line-height: 25px; margin: auto; text-align: start;">
            public function editar(Request $request){

                $this->validate($request,[
                    'descripcion' => 'required',
                    'descuento' => 'required'
                ]);
                $id = $request->input('id');;
                $url = env("URL_SERVER_API", 'http://127.0.0.1');
                $response = Http::put($url . '/Servicios/'. $id, [
                    'descripcion' => $request->descripcion,
                    'descuento' => $request->descuento
                ]);
        
                $edit = $response->json();
                return back()->with('mensaje', $edit['message']); 
            }
           </span>
           <i class="fa-regular fa-copy" style="width: 5%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 25px; cursor: pointer;"></i>
        </div>
        
    </div>
    <script>
        function copy() {
            var chk = document.getElementById("check");
            var cop = document.getElementById("copy");

            cop.style.display = 'none';
            if (getComputedStyle(cop).display === 'none') {
                chk.style.display = 'flex';
            }
        }
    </script>
    </body>
</html>
