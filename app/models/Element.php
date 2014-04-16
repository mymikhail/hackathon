<?php

	class ElementCouchDao extends \Simplon\Db\Abstracts\DAO\AbstractCouchDAO
    {
        const ID_REFERENCE = 'id';

        const FIELD_ID = 's:id';
        const FIELD_USERNAME = 's:username';
        const FIELD_CREATED = 's:created';
        const FIELD_UPDATED = 's:updated';

        public function setId($value)
        {
            $this->_setByKey(UserCouchDao::FIELD_ID, $value);

            return $this;
        }

        public function getId()
        {
            return $this->_getByKey(UserCouchDao::FIELD_ID);
        }

        public function setUsername($value)
        {
            $this->_setByKey(UserCouchDao::FIELD_USERNAME, $value);

            return $this;
        }

        public function getUsername()
        {
            return $this->_getByKey(UserCouchDao::FIELD_USERNAME);
        }

        public function setCreated($value)
        {
            $this->_setByKey(UserCouchDao::FIELD_CREATED, $value);

            return $this;
        }

        public function getCreated()
        {
            return $this->_getByKey(UserCouchDao::FIELD_CREATED);
        }

        public function setUpdated($value)
        {
            $this->_setByKey(UserCouchDao::FIELD_UPDATED, $value);

            return $this;
        }

        public function getUpdated()
        {
            return $this->_getByKey(UserCouchDao::FIELD_UPDATED);
        }
    }