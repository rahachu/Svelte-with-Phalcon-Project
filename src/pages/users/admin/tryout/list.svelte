<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Harga</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tryout 1</td>
                <td>20.000</td>
                <td><button class="button is-info is-small">Edit</button></td>
                <td><button class="button is-link is-small">Publish</button></td>
                <td><button class="button is-danger is-small">Hapus</button></td>
            </tr>
            <tr>
                <td>Tryout 2</td>
                <td>20.000</td>
                <td><button class="button is-info is-small">Edit</button></td>
                <td><button class="button is-link is-small" disabled>Publish</button></td>
                <td><button class="button is-danger is-small">Hapus</button></td>
            </tr>
        </tbody>
        <tfoot>
            <td><input class="input" type="text" placeholder="Judul Tryout"></td>
            <td><input class="input" type="text" placeholder="Harga"></td>
            <td colspan="3"><button class="button is-primary">Tambah Tryout</button></td>
        </tfoot>
    </table>
</div>