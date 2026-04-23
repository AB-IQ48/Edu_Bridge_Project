<p class="role-badge-inline" style="margin-bottom:10px;">{{ $panel === 'student' ? 'Student' : 'Counsellor' }}</p>
<h1>Make a complaint</h1>
<p class="sub">Describe what happened. Include dates and any relevant detail. See our <a href="{{ route('pages.complaints') }}">complaint policy</a> for what we can handle.</p>

<form method="POST" action="{{ route($panel.'.complaints.store') }}" class="grid" style="gap:14px;">
    @csrf
    <div>
        <label for="category">Category</label>
        <select id="category" name="category" required>
            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Choose one</option>
            @foreach($categories as $key => $label)
                <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="subject">Subject</label>
        <input id="subject" name="subject" type="text" required maxlength="255" value="{{ old('subject') }}">
    </div>
    <div>
        <label for="body">Details</label>
        <textarea id="body" name="body" rows="8" required maxlength="8000">{{ old('body') }}</textarea>
    </div>
    <div class="eb-complaints-actions" style="margin-top:4px;">
        <button type="submit" class="btn btn--sage eb-complaint-action-btn">Submit complaint</button>
        <a href="{{ route($panel.'.complaints.index') }}" class="btn btn--ghost eb-complaint-action-btn">Cancel — back to list</a>
    </div>
</form>
