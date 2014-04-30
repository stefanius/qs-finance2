<div class="view">
    <table>

        <tr>
            <td><strong><em>Key</em></strong></td>
            <td><strong><em>Value</em></strong></td>
        </tr>

        <?php foreach($data[$objectKey] as $key => $value): ?>
            <tr>
                <td><strong><?php echo ucfirst($key); ?></strong></td>
                <td><?php echo ucfirst($value); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
