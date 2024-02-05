<x-update-modal-component title="تعديل البند ">
    <div class="col-12 mb-2">
        <div class="col-12 mb-2 calc">
            <div class="form-group my-3">
                <label for='qty'>الكمية </label>
                <table id="calcu" >
                    <tr>
                        <td colspan="9">
                            <input type="text" wire:model="qty" class="form-control" readonly id="result">
                            @include('inc.livewire_errors',['property'=>'qty'])
                        </td>
                    </tr>

                    <tr>
                        <td><input type="button" value="1" wire:click="addDigit('1')"> </td>
                        <td><input type="button" value="2" wire:click="addDigit('2')"> </td>
                        <td><input type="button" value="3" wire:click="addDigit('3')"> </td>
                        <td><input type="button" value="." wire:click="addDigit('.')"> </td>
                    </tr>
                    <tr>
                        <td><input type="button" value="4" wire:click="addDigit('4')"> </td>
                        <td><input type="button" value="5" wire:click="addDigit('5')"> </td>
                        <td><input type="button" value="6" wire:click="addDigit('6')"> </td>
                        <td><input type="button" value="c" wire:click="clearQty()" /> </td>
                    </tr>
                    <tr>
                        <td><input type="button" value="7" wire:click="addDigit('7')"> </td>
                        <td><input type="button" value="8" wire:click="addDigit('8')"> </td>
                        <td><input type="button" value="9" wire:click="addDigit('9')"> </td>
                        <td><input type="button" value="0" wire:click="addDigit('0')"> </td>
                    </tr>
                    <tr>
                        <td colspan="6"><input type="button" value="-" wire:click="addDigit('-')"> </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>
</x-update-modal-component>
