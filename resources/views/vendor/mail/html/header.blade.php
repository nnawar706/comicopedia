@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;font-size: 15px;">
@if (trim($slot) === 'Laravel')
MANGAMANIA
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
