<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //recuperare tutti i project dal database 
        $projects = Project::all();
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        //porta a una view per la creazione di un nuovo project
        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectStoreRequest $request)
    {
        //i dati inviati vengono validati tramite il from request
        $data = $request->validated();

        $data["slug"] = $this->generateSlug($data["title"]);

        // per salvare quel file all’interno dello storage usiamo il comando Storage::put("sottocartella", $data["chiave_file"])
        $data["thumbnail"] = Storage::put("projects", $data["thumbnail"]);

        // $project = new Post();
        // $project->fill($data);
        // $project->save()

        // Il ::create esegue il fill e il save in un unico comando
        $project = Project::create($data);

        // se l'array associativo $data contiene una chiave chiamata "technologies"
        if (key_exists("technologies", $data)) {
            //attach($data["technologies"]) = Operazione di "associamento" tra un progetto e un insieme di tecnologie
            $project->technologies()->attach($data["technologies"]);
        }

        //l'utente viene reindirizzato a un'altra pagina
        return redirect()->route("admin.projects.show", $project->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        //una query dove lo slug corrispondente a $slug
        $project = Project::where("slug", $slug)->first();

        //porta a una view dove si visualizzano i dettagli del singolo project.
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // è utilizzato per recuperare i dettagli di un singolo project specifico ed editarlo
    public function edit($slug)
    {
        $types = Type::all();

        $technologies = Technology::all();

        //una query dove lo slug corrispondente a $slug
        $project = Project::where("slug", $slug)->first();

        //porta a una view per la modifica di un project
        return view("admin.projects.edit", compact("project", "types", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpdateRequest $request, $slug)
    {
        //una query dove lo slug corrispondente a $slug
        $project = Project::where("slug", $slug)->first();

        $data = $request->validated();

        //se i due titoli sono diversi  genera un nuovo "slug" basato sul nuovo titolo.
        if ($data["title"] !== $project->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }


        // se la thumbnail ha un valore cambia la thum  e viene chiamato il metodo delete della classe Storage per eliminare il file, altrimenti metti quella di prima 
        if (isset($data["thumbnail"])) {
            $data["thumbnail"] = Storage::put("projects", $data["thumbnail"]);
            Storage::delete($project["thumbnail"]);
        } else {
            $data["thumbnail"] =  $project["thumbnail"];
        }

        /*sync($data["technologies"] =  Le relazioni esistenti tra il progetto e le tecnologie verranno rimosse, e poi saranno create nuove relazioni con le tecnologie specificate in $data["technologies"]. */
        $project->technologies()->sync($data["technologies"]);

        // update fa un fill() + save()
        $project->update($data);

        //l'utente viene reindirizzato a un'altra pagina
        return redirect()->route("admin.projects.show", $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $project = Project::where("slug", $slug)->first();

        //se $project["thumbnail"] ha un valore viene chiamato il metodo delete della classe Storage per eliminare il file
        if ($project["thumbnail"]) {
            Storage::delete($project["thumbnail"]);
        }

        //detach() senza argomenti, l'effetto è quello di rimuovere tutte le relazioni tra il progetto e le tecnologie associate.
        $project->technologies()->detach();

        //Il metodo delete() elimina il singolo project associato
        $project->delete();

        //l'utente viene reindirizzato a un'altra pagina
        return redirect()->route("admin.projects.index");
    }

    protected function generateSlug($title)
    {
        // contatore da usare per avere un numero incrementale
        $counter = 0;

        do {
            // creo uno slug e se il counter è maggiore di 0, concateno il counter
            $slug = Str::slug($title) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste già un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // finché esiste già un elemento con questo slug, ripeto il ciclo per creare uno slug nuovo

        return $slug;
    }
}
