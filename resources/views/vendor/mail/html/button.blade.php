@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
    <x-link class="button bg-{{ $color }}" href="{{ $url }}" target="_blank" rel="noopener">{{ $slot }}</x-link>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
