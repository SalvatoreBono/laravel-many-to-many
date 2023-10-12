<div class="container pt-3">
    {{-- action="{{ $action }}"= è un segnaposto  --}}
    <form action="{{ $action }}" class="row g-3" method="POST" enctype="multipart/form-data">
        @csrf()
        {{-- @method($method) = è un segnaposto --}}
        @method($method)

        <div class="col-12">
            <label for="inputTitle" class="form-label">Nome repository</label>
            {{-- value="{{ old('email'= ottenere il valore precedentemente inviato --}}
            {{-- , $name?->email) }} = stampare il valore di email --}}
            {{-- , $name?->email) }} = "?" se la variabile $name non è definito assegna "null"  --}}
            <input type="text" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $project?->title) }}" id="inputTitle" name="title">
            @error('title')
                <div class="invalid_feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control @error('description')is-invalid @enderror" name="description"
                    placeholder="Leave a comment here" id="floatingTextarea">{{ old('description', $project?->description) }}</textarea>
                <label for="floatingTextarea">Descrizione</label>
                @error('description')
                    <div class="invalid_feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <label for="inputThumbnail" class="form-label">Miniatura</label>
            <input type="file" accept="image/*"
                class="form-control @error('thumbnail')
                is-invalid
            @enderror"
                id="inputThumbnail" name="thumbnail">
            @error('thumbnail')
                <div class="invalid_feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="inputLink" class="form-label">Link</label>
            <input type="url" class="form-control @error('link')
                is-invalid
            @enderror"
                id="inputLink" name="link" value="{{ old('link', $project?->link) }}">
            @error('link')
                <div class="invalid_feedback">{{ $message }}</div>
            @enderror
        </div>
        <div>

        </div>
        <div class="col-2">
            <label for="inputDate" class="form-label">Data</label>
            <input type="date" class="form-control @error('date')
                is-invalid
            @enderror"
                id="inputDate" name="date" value="{{ old('date', $project?->date->format('Y-m-d')) }}">
            @error('date')
                <div class="invalid_feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-3">
            <label for="inputDate" class="form-label">Tipologia</label>

            <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example"
                name="type_id">
                <option selected>Scegli la tipologia di lavoro</option>
                @foreach ($types as $type)
                    {{-- {{ $project->type_id === $type->id ? 'selected' : '' }}  = se type_id è uguale a id dai selected altrimenti stringa vuota --}}
                    <option value="{{ $type->id }}" {{ $project?->type_id === $type->id ? 'selected' : '' }}>
                        {{ $type->type }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid_feedback">{{ $message }}.</div>
            @enderror
        </div>
        <div class="col-12">
            <label class="form-check-label" for="gridCheck">
                Linguaggi utilizzati
            </label>
            <div>
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="technologies[]"
                            {{ $project?->technologies->contains($technology) ? 'checked' : '' }}
                            value="{{ $technology->id }}">
                        <label class="form-check-label" for="gridCheck">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
                @error('technologies')
                    <div class="invalid_feedback">{{ $message }}.</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Conferma</button>
            <a href="{{ $btnBack }}" class="btn btn-danger ">Indietro</a>
        </div>
    </form>
</div>
