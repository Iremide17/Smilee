<div>
    <select wire:change="setDuration({{ $booking }}, $event.target.value)" id="duration"
        class="form-control w-full text-sm text-center border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <option value="">Select Duration</option>
        <option value="1" @if($booking->duration() === '1') selected @endif>1</option>
        <option value="2" @if($booking->duration() === '2') selected @endif>2</option>
        <option value="3" @if($booking->duration() === '3') selected @endif>3</option>
        <option value="4" @if($booking->duration() === '4') selected @endif>4</option>
        <option value="5" @if($booking->duration() === '5') selected @endif>5</option>
        <option value="6" @if($booking->duration() === '6') selected @endif>6</option>
        <option value="7" @if($booking->duration() === '7') selected @endif>7</option>
        <option value="8" @if($booking->duration() === '8') selected @endif>8</option>
        <option value="9" @if($booking->duration() === '9') selected @endif>9</option>
        <option value="10" @if($booking->duration() === '10') selected @endif>10</option>
        <option value="11" @if($booking->duration() === '11') selected @endif>11</option>
        <option value="12" @if($booking->duration() === '12') selected @endif>12</option>
    </select>
    <x-form.error for="duration" />
</div>
