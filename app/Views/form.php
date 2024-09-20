<div class="container">
    <h3>Blok dan Mata Pelajaran</h3>

    <?php if (!empty($blocks)): ?>
        <form method="post" action="/save-answers">
            <?php foreach ($blocks as $block): ?>
                <div class="block-section">
                    <h4>Blok: <?= $block->nama_blok; ?></h4>
                    <p>Guru: <?= $block->username; ?> (Mapel: <?= $block->nama_mapel; ?>)</p>
                    
                    <!-- Display questions for each block -->
                    <?php if (isset($questions_by_block[$block->id_blok])): ?>
                        <div class="questions-section">
                            <?php foreach ($questions_by_block[$block->id_blok] as $question): ?>
                                <p><?= $question->pertanyaan; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Tidak ada pertanyaan untuk blok ini.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <p>Tidak ada data blok atau mata pelajaran yang tersedia untuk kelas ini.</p>
    <?php endif; ?>
</div>
