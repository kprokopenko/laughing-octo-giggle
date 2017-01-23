<?php


class Db
{
    const DSN = 'sqlite:' . __DIR__. '/../test_dump_2.db';

    const PK_COLUMN = 'id';

    const TABLE_NAME = 'detail_tickets';

    const DEFAULT_COLUMN = 'section';

    const UPDATED_COLUMN = 'section_human';

    /**
     * @var PDO
     */
    private $db;

    /**
     * @var PDOStatement
     */
    private $rows;

    private $currentId;

    /**
     * @var PDOStatement
     */
    private $updatePrep;

    private function openDb()
    {
        $this->db = new PDO(self::DSN);
        $this->updatePrep = $this->db->prepare(
            'UPDATE ' . self::TABLE_NAME . ' SET ' . self::UPDATED_COLUMN . ' = :updateValue WHERE id = :id'
        );
    }

    private function loadData()
    {
        $this->rows = $this->db->query('select * from ' . self::TABLE_NAME);
    }

    public function __construct()
    {
        $this->openDb();
        $this->loadData();
        $this->db->beginTransaction();
    }

    public function __destruct()
    {
        $this->db->commit();
    }

    public function next()
    {
        $result = $this->rows->fetch();

        if ($result === false) {
            return false;
        }

        $this->currentId = $result[self::PK_COLUMN];

        return $result[self::DEFAULT_COLUMN];
    }

    public function update($value)
    {
        $this->updatePrep->bindValue(':updateValue', $value);
        $this->updatePrep->bindValue(':id', $this->currentId);
        $this->updatePrep->execute();
    }
}